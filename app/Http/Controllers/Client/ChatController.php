<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $userMessage = $request->input('message');

        if (!$userMessage) {
            return response()->json(['reply' => 'Bạn chưa nhập câu hỏi nào cả.']);
        }

        try {
            $msg = Str::lower($userMessage);
            $isSale = Str::contains($msg, ['sale', 'giảm giá', 'khuyến mãi', 'rẻ']);
            $isBest = Str::contains($msg, ['nhất', 'sâu', 'khủng', 'mạnh', 'top']);
            
            $relevantProducts = collect();
            $contextNote = "";
            $isFallback = false; // Cờ đánh dấu: Có tìm thấy hàng trong kho không?

            // --- 1. LOGIC TÌM KIẾM TRONG KHO ---
            $stopWords = ['tôi', 'muốn', 'mua', 'cần', 'tìm', 'có', 'không', 'với', 'là', 'của', 'cho', 'giá', 'rẻ', 'tốt', 'nhất', 'shop', 'bên', 'mình', 'em', 'ơi', 'tư', 'vấn', 'biết', 'về', 'thông', 'tin'];
            $keywords = array_filter(explode(' ', $msg), function($w) use ($stopWords) {
                return !in_array($w, $stopWords) && strlen($w) > 1;
            });

            $query = Product::with(['category', 'brand'])->where('status', 1);
            
            // Nếu hỏi sale, ưu tiên lọc sale
            if ($isSale) {
                $query->whereNotNull('sale_price')->whereColumn('sale_price', '<', 'price');
            }

            $allProducts = $query->get();

            $scoredProducts = $allProducts->map(function ($product) use ($keywords) {
                $score = 0;
                $searchString = Str::lower($product->name . ' ' . ($product->category->name ?? '') . ' ' . ($product->brand->name ?? ''));
                foreach ($keywords as $word) {
                    if (str_contains($searchString, $word)) $score++;
                }
                $product->search_score = $score;
                return $product;
            });

            $relevantProducts = $scoredProducts->where('search_score', '>', 0)->sortByDesc('search_score')->take(5);

            // --- 2. XỬ LÝ KHI KHÔNG TÌM THẤY (FALLBACK) ---
            if ($relevantProducts->isEmpty()) {
                $isFallback = true; // Đánh dấu là không tìm thấy
                
                // Vẫn lấy 3 sản phẩm mới nhất để làm "Gợi ý" (tránh trả về rỗng)
                $relevantProducts = Product::where('status', 1)->latest()->take(3)->get();
                $contextNote = "Hiện tại kho hàng KHÔNG CÓ sản phẩm khớp chính xác yêu cầu. Dưới đây là danh sách sản phẩm gợi ý thay thế:";
            } else {
                $contextNote = "Dưới đây là các sản phẩm có sẵn tại shop phù hợp với yêu cầu:";
            }

            // --- 3. TẠO CONTEXT ---
            $productContext = $contextNote . "\n";
            foreach ($relevantProducts as $product) {
                $link = route('client.product.detail', $product->slug);
                
                if ($product->sale_price && $product->sale_price < $product->price) {
                    $priceInfo = number_format($product->sale_price) . "đ";
                    $status = " [ĐANG SALE]";
                } else {
                    $priceInfo = number_format($product->price) . "đ";
                    $status = "";
                }
                $productContext .= "- {$product->name}{$status} | Giá: {$priceInfo} | Link: {$link}\n";
            }

            // --- 4. TẠO PROMPT THÔNG MINH (QUAN TRỌNG) ---
            $apiKey = env('GEMINI_API_KEY');
            
            if ($isFallback) {
                // PROMPT KHI KHÔNG CÓ HÀNG: Cho phép AI dùng kiến thức ngoài
                $prompt = "Bạn là chuyên gia công nghệ của 'Computer Shop'.\n" .
                          "Khách hỏi: \"$userMessage\"\n\n" .
                          "Tình trạng kho: Shop hiện KHÔNG CÓ sản phẩm khách hỏi.\n" .
                          "Danh sách gợi ý thay thế:\n$productContext\n\n" .
                          "YÊU CẦU TRẢ LỜI:\n" .
                          "1. Dùng kiến thức của bạn để tư vấn/giải thích về sản phẩm khách hỏi (thông số, có tốt không, ra mắt năm nào...) dù shop không bán.\n" .
                          "2. Sau đó, khéo léo báo là shop hiện chưa kinh doanh mẫu đó.\n" .
                          "3. Mời khách tham khảo các sản phẩm gợi ý thay thế trong danh sách trên.\n" .
                          "4. Giọng điệu: Chuyên gia, khách quan, thân thiện.";
            } else {
                // PROMPT KHI CÓ HÀNG: Tập trung bán hàng trong kho
                $prompt = "Bạn là nhân viên bán hàng của 'Computer Shop'.\n" . 
                          "Khách hỏi: \"$userMessage\"\n\n" .
                          "Danh sách sản phẩm có sẵn:\n$productContext\n\n" .
                          "YÊU CẦU TRẢ LỜI:\n" .
                          "1. Tư vấn dựa trên danh sách trên.\n" .
                          "2. Nếu sản phẩm có [ĐANG SALE], hãy nhấn mạnh giá tốt.\n" .
                          "3. Trả lời ngắn gọn, kèm link mua hàng.";
            }

            // --- 5. GỌI API ---
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}";

            $response = Http::withoutVerifying()
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, ['contents' => [['parts' => [['text' => $prompt]]]]]);

            if ($response->successful()) {
                return response()->json(['reply' => $response->json()['candidates'][0]['content']['parts'][0]['text']]);
            } else {
                return response()->json(['reply' => 'Hệ thống đang bận chút xíu, bạn đợi lát nhé.']);
            }

        } catch (\Exception $e) {
            Log::error('Chat Error: ' . $e->getMessage());
            return response()->json(['reply' => 'Lỗi hệ thống.']);
        }
    }
}