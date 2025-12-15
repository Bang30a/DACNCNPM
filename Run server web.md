# **🌐 Hướng dẫn chạy Server và Public Web bằng Ngrok**

Đây là các bước để đưa website từ máy tính cá nhân (Localhost) lên mạng Internet để người khác có thể truy cập được.

### **Bước 1: Kết nối Ngrok với tài khoản (Xác thực)**

*Bước này chỉ cần làm một lần đầu tiên khi mới tải Ngrok.*

1. Mở thư mục chứa file ngrok.exe bạn đã giải nén.  
2. Tại thanh địa chỉ của thư mục đó, gõ cmd và nhấn **Enter** để mở cửa sổ dòng lệnh.  
3. Copy dòng lệnh chứa mã Token của bạn (lấy từ trang dashboard của Ngrok) và dán vào cửa sổ CMD, sau đó nhấn **Enter**.  
   * Ví dụ: ngrok config add-authtoken 2A...  
   * Nếu thấy thông báo: Authtoken saved to configuration file... là thành công.

### **Bước 2: Chạy Web Laravel (Localhost)**

*Luôn giữ cửa sổ này hoạt động, không được tắt.*

1. Mở **Visual Studio Code** hoặc cửa sổ CMD tại thư mục dự án Laravel của bạn.  
2. Gõ lệnh sau để khởi động server nội bộ:  
   php artisan serve

3. Server sẽ chạy tại địa chỉ: http://127.0.0.1:8000.

### **Bước 3: Public web ra ngoài Internet**

1. Quay lại cửa sổ CMD của **Ngrok** (đã mở ở Bước 1).  
2. Gõ lệnh sau và nhấn **Enter**:  
   ngrok http 8000

   *(Số 8000 phải khớp với cổng mà Laravel đang chạy)*.  
3. Màn hình sẽ hiện ra bảng trạng thái **Session Status**. Hãy tìm dòng **Forwarding**.  
   * Bạn sẽ thấy địa chỉ có dạng: https://xxxx-xxxx-xxxx.ngrok-free.app \-\> http://localhost:8000  
   * 👉 **Link https://...ngrok-free.app chính là link public\!**  
4. Copy link này gửi cho bạn bè hoặc thầy cô để họ truy cập vào website của bạn.

### **⚠️ Lưu ý quan trọng:**

* **Không được tắt** cửa sổ php artisan serve lẫn cửa sổ ngrok trong quá trình demo. Nếu tắt 1 trong 2, web sẽ sập.  
* Link Ngrok miễn phí sẽ **thay đổi** mỗi lần bạn tắt đi bật lại. Hãy nhớ gửi link mới nhất cho người xem.  
* Khi người khác vào link lần đầu, họ có thể thấy màn hình cảnh báo của Ngrok, hãy bấm nút **"Visit Site"** để tiếp tục.