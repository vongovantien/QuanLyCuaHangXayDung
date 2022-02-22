<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExports;
use App\Imports\ProductImports;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ImportController extends Controller
{
    public function import_product(Request $request)
    {
        if($request->file != null) {
            Excel::import(new ProductImports, $request->file);
            return redirect('admin/products/list');
        }

        Session::flash('error', 'Vui lòng chọn file để import!!');

        return redirect()->back();

    }
}
