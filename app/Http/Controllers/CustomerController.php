<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        (string)$kw = $request->query('kw');
        (int)$quantity = $request->query('quantity');
        (string)$filter = $request->query('filter');
        $customers = DB::table('customers')->orderByDesc('id');

        if ($kw !== null) {
            $customers = $customers->where('name', 'like', "%$kw%");
        }
        if ($filter !== null) {
            switch ($filter) {
                case "date" :
                    $customers = $customers->orderBy('id');
                    break;
                case "date_desc":
                    $customers = $customers->orderByDesc('id');
                    break;
                case "name_desc":
                    $customers = $customers->orderByDesc('name');
                    break;
                default:
                    $customers = $customers->orderBy('name');
            }
        }
        if ($quantity !== null) {
            $customers = $customers->paginate($quantity);
        } else {
            $customers = $customers->paginate(15);
        }


        return view('admin.customer.list', [
            'customers' => $customers,
            'title' => 'Danh sách sản phẩm'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.add', [
            'title' => 'Thêm sản phẩm mới'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required'
        ])->validate();

        try {
            Customer::create([
                'name' => $request->name,
                'address' => $request->address,
            ]);

            Session::flash('success', 'Tạo mới khách hàng thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Tạo mới khách hàng thất bại' . ' ' . $err->getMessage());
        }
        if ($request->has('back')) {
            return redirect('admin/customers/list');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
