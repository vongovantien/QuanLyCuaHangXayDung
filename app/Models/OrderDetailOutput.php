<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailOutput extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'order_output_id',
        'quantity',
        'price',
    ];

    public function order_output()
    {
        return $this->belongsTo(OrderInput::class, 'order_output_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
