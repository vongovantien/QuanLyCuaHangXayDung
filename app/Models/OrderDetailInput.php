<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailInput extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_input_id',
        'quantity',
        'price',
    ];

    public function order_input()
    {
        return $this->belongsTo(OrderInput::class, 'order_input_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
