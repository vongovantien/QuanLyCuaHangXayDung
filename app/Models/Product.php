<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = [
        'name',
        'description',
        'unit',
        'category_id',
        'supplier_id',
        'price',
        'price_sale',
        'active',
        'images'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public static function getProducts()
    {
        $record = DB::table('products')->select('id', 'name', 'unit', 'price')->get()->toArray();
        return $record;
    }
}
