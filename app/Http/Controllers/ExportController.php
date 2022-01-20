<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ExcelExports;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export_product()
    {
        return Excel::download(new ExcelExports, 'products.xlsx');
    }

}
