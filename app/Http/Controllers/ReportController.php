<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function ProfitStats(Request $request)
    {
        //theo quy
        //SELECT Quarter(created_at) as 'Quý', Year(created_at), price*quantity as 'Doanh thu'
        //FROM order_detail_outputs
        //WHERE YEAR(created_at) = 2021
        //GROUP BY Quarter(created_at)

        //theo thang cua nam
        //SELECT Month(created_at) as 'thang', Year(created_at), price*quantity as 'Doanh thu' FROM order_detail_outputs WHERE YEAR(created_at) = 2021
        //GROUP BY Month(created_at)

        //theo nam
        //SELECT YEAR(created_at), price*quantity as 'Doanh thu' FROM order_detail_outputs GROUP BY YEAR(created_at)
        //select price * quantity as Doanh_thu,, YEAR(created_at) as year from `order_detail_inputs` group by `year`
        $record = DB::table("order_detail_outputs")
            ->selectRaw('price * quantity as "doanh_thu", year(created_at) as year')
            ->groupBy('year')
            ->get();

        return view('admin.report.profit', [
            'title' => 'Thống kê',
            'record' => $record
        ]);
    }

    public function CateStats()
    {
        $record = DB::table("categories")
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->select(DB::raw('count(*) as product_count, categories.name'))
            ->groupBy('name')
            ->get();

        return view('admin.report.productState', [
            'title' => 'Thống kê theo loại sản phẩm',
            'record' => $record
        ]);
    }
    public function MonthStats(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        $record = DB::table("order_detail_outputs")
            ->selectRaw('price * quantity as "doanh_thu", Month(created_at) as thang, Year(created_at) as nam')
            ->where(DB::raw('YEAR(created_at)'), '=', $year)
            ->groupBy(DB::raw('Month(created_at)'))
            ->get();

        return view('admin.report.month', [
            'title' => 'Thống kê doanh thu trong năm',
            'record' => $record
        ]);
    }

    //theo quy
    //SELECT Quarter(created_at) as 'Quý', Year(created_at), price*quantity as 'Doanh thu'
    //FROM order_detail_outputs
    //WHERE YEAR(created_at) = 2021
    //GROUP BY Quarter(created_at)
    public function QuarterStats(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        $record = DB::table("order_detail_outputs")
            ->selectRaw('price * quantity as "doanh_thu", Quarter(created_at) as quy, Year(created_at) as nam')
            ->where(DB::raw('YEAR(created_at)'), '=', $year)
            ->groupBy(DB::raw('Quarter(created_at)'))
            ->get();

        return view('admin.report.quarter', [
            'title' => 'Thống kê doanh thu trong năm',
            'record' => $record
        ]);
    }
}

