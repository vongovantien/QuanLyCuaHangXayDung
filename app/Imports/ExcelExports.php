<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelExports implements ToModel
{

    public function model(array $row)
    {
        return new \App\Models\ExcelExports([
            'name' => $row['name'],
            'description' => $row['description']
        ]);
    }
}
