<?php

namespace App\Http\Controllers;

use App\Models\OrderDetailInput;
use App\Models\OrderInput;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderInputController extends Controller
{
    public function getAllSupplier()
    {
        return Supplier::all();
    }

    public function getAllProduct()
    {
        return Product::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders_input = OrderInput::all();
        return view('admin.orderinput.list', [
            'orders_input' => $orders_input,
            'title' => 'Danh sách đơn hàng nhập'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = $this->getAllSupplier();
        $products = $this->getAllProduct();
        return view('admin.orderinput.add', [
            'suppliers' => $suppliers,
            'products' => $products,
            'title' => 'Tạo đơn hàng nhập hàng'
        ]);
    }

    /**
     * Store a newly created resource in sto    rage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ])->validate();
        try {
            OrderDetailInput::create([
                'product_id' => $request->product,
                'order_input_id' => $request->order_input,
                'quantity' => $request->quantity,
                'price' => $request->price,
            ]);
            OrderInput::create([
                'supplier_id' => $request->supplier,
                'employee_id' => $request->employee,
            ]);

            Session::flash('success', 'Tạo mới đơn hàng nhập thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Tạo mới đơn hàng nhập thất bại' . ' ' . $err->getMessage());
        }
        if ($request->has('back')) {
            return redirect('admin/products/list');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
