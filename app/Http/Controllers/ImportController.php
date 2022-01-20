<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExports;
use App\Imports\ProductImports;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import_product(Request $request)
    {
        Excel::import(new ProductImports, $request->file);
        return redirect('admin/products/list');
    }
}
