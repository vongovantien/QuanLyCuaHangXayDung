<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExports implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Unit',
            'Price',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
//        return Product::all();
        return collect(Product::getProducts());
    }
}
