<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImports implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'unit' => $row['unit'],
            'category_id' => $row['category_id'],
            'supplier_id' => $row['supplier_id'],
            'price' => $row['price'],
            'images' => $row['images'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
