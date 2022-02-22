@extends('admin.main')
@section('content')
    <div class="container p-5">
        <h3>Thông tin sản phẩm</h3>
        <p>Mã sản phẩm: {{$product->id}}</p>
        <p>Tên sản phẩm: {{$product->name}}</p>
        <p>Miêu tả sản phẩm: {{$product->description}}</p>
        <p>Đơn vị tính: {{$product->unit}}</p>
        <p>Tên loại sản phẩm: {{$product->category_id}}</p>
        <p>Tên nhà cung cấp: {{$product->supplier_id}}</p>
        <p>Giá sản phẩm: {{number_format($product->price, 0, '', '.')}} VNĐ</p>
        <p>Trạng thái: {{$product->active}}</p>
        <p>Ngày tạo sản phẩm: {{$product->created_at->format('d/m/Y')}}</p>
        <div class="w-25">
            <img class="img w-100"
                 src="/images/{{$product->images}}"
                 alt="{{$product->name}}"/>
        </div>


    </div>

@endsection
