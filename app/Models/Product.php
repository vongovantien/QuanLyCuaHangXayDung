<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'name',
        'description',
        'unit',
        'origin',
        'category_id',
        'supplier_id',
        'price',
        'price_sale',
        'active',
        'images'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }
}
