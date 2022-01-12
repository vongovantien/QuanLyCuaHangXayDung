@extends('admin.main')
@section('content')

    <div class="container p-5">
        <h3>Cập nhật sản phẩm</h3>
        @include('admin.alert')
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product name:</label>
                <input type="text" class="form-control" placeholder="Enter your product name" id="name" name="name"
                       value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" placeholder="Enter description" id="description"
                       name="description"
                       value="{{ $product->description }}">
            </div>
            <div class="form-group">
                <label for="unit">Unit:</label>
                <select name="unit" class="custom-select">
                    <option value="Cái">Cái</option>
                </select>
            </div>
            <div class="form-group">
                <label for="supplier">Supplier:</label>
                <select name="supplier" class="custom-select">
                    <option selected>Chọn nhà cung cấp</option>
                    @foreach($suppliers as $sup)
                        <option
                            value="{{$sup->id}}" {{$product->supplier_id == $sup->id ? 'selected' : ''}}>{{$sup->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" class="custom-select">
                    <option selected>Chọn loại sản phẩm</option>
                    @foreach($categories as $cate)
                        <option
                            value="{{$cate->id}}" {{$product->category_id == $cate->id ? 'selected' : ''}}>{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div>
                <img class="img w-50" src="/images/{{ $product->images }}" alt="{{ $product->name }}">
            </div>
            <div class="my-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" id="active" value="0" {{ $product->active == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Hết hàng</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" id="active" value="1" {{ $product->active == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Còn hàng</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-3">Create</button>
        </form>
    </div>
@endsection
