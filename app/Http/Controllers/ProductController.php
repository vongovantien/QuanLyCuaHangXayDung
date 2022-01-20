<?php

namespace App\Http\Controllers;

use App\Imports\ExcelExports;
use App\Exports\ExcelExports as Export;
use App\Models\ExcelExports as Exmodel;
use App\Http\Controllers\Exception;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function response;
use function view;

class ProductController extends Controller
{

    public function getAllCategory()
    {
        return Category::where('active', 1)->get();
    }

    public function getAllSupplier()
    {
        return Supplier::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        (string)$kw = $request->query('kw');
        (int)$quantity = $request->query('quantity');
        (string)$filter = $request->query('filter');
        $products = Product::with('category')->orderByDesc('id');

        if ($kw !== null) {
            $products = $products->where('name', 'like', "%$kw%");
        }
        if ($filter !== null) {
            switch ($filter) {
                case "date" :
                    $products = $products->orderBy('id');
                    break;
                case "date_desc":
                    $products = $products->orderByDesc('id');
                    break;
                case "name_desc":
                    $products = $products->orderByDesc('name');
                    break;
                default:
                    $products = $products->orderBy('name');
            }
        }
        if ($quantity !== null) {
            $products = $products->paginate($quantity);
        } else {
            $products = $products->paginate(15);
        }


        return view('admin.product.list', [
            'products' => $products,
            'title' => 'Danh sách sản phẩm'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $cate = $this->getAllCategory();
        $supplier = $this->getAllSupplier();
        return view('admin.product.add', [
            'cates' => $cate,
            'supplier' => $supplier,
            'title' => 'Thêm sản phẩm mới'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Bạn phải nhâp tên sản phẩm!!',
            'price.required' => 'Bạn phải nhập giá của sản phẩm!!'
        ];
        Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ], $messages)->validate();

        $filename = "";
        if ($request->file('image')->isValid()) {
            $filename = $request->image->getClientOriginalName();
            $request->image->move('images/', $filename);
        }
        try {
            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'unit' => $request->unit,
                'category_id' => $request->category,
                'supplier_id' => $request->supplier,
                'price' => $request->price,
                'active' => $request->active,
                'images' => $filename
            ]);

            Session::flash('success', 'Tạo mới sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Tạo mới sản phẩm thất bại' . ' ' . $err->getMessage());
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
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->getAllCategory();
        $suppliers = $this->getAllSupplier();
        $product = Product::where('id', $id)->first();
        return view('admin.product.edit', [
            'title' => 'Sửa sản phẩm',
            'product' => $product,
            'categories' => $categories,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->with('category', 'supplier')->first();
        return view('admin.product.detail', [
            'title' => $product['name'],
            'product' => $product,
        ]);
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
        $messages = [
            'name.required' => 'Bạn phải nhập tên sản phẩm!!',
            'price.required' => 'Bạn phải nhập giá của sản phẩm!!'
        ];
        Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ], $messages)->validate();

        $product = Product::find($id);
        $filename = "";
        if ($request->has('image') && $request->file('image')->isValid()) {
            $filename = $request->image->getClientOriginalName();

            $request->image->move('images/', $filename);
        }
        if ($request->has('image') != null) {
            if (file_exists(public_path('images/' . $product->images))) {
                unlink('images/' . $product->images);
            }
        }
        try {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->unit = $request->unit;
            $product->category_id = $request->category;
            $product->supplier_id = $request->supplier;
            $product->price = $request->price;
            $product->active = $request->active;
            $product->images = $filename;
            $product->save();
            Session::flash('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật sản phẩm thất bại' . ' ' . $err->getMessage());
            redirect()->back();
        }
        return redirect('/admin/products/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = (int)$request->input('id');
        $product = Product::where('id', $id)->first();
        try {
            if ($product) {
                $product->delete();
            }

            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        } catch (Exception $err) {
            return response()->json(['error' => true]);
        }
    }
}
