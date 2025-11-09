<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'user_id', 'customer_name', 'customer_phone', 'customer_email',
    'shipping_address', 'note', 'total_amount', 'status', 'payment_method'
];

// Quan hệ với OrderDetail
public function details() {
    return $this->hasMany(OrderDetail::class);
}
}
