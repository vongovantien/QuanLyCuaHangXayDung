@extends('admin.main')
@section('content')

    <div class="container p-5">
        <h3>Thêm mới sản phẩm</h3>
        @include('admin.alert')
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product name:</label>
                <input type="text" class="form-control" placeholder="Enter your product name" id="name" name="name"
                       value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" placeholder="Enter description" id="description"
                       name="description" value="{{ old('description')}}">
            </div>
            <div class="form-group">
                <label for="unit">Unit:</label>
                <select name="unit" class="custom-select">
                    <option selected>Chọn đơn vị tính</option>
                    <option value="Khối">Khối</option>
                    <option value="Mét">Mét</option>
                    <option value="Tấn">Tấn</option>
                    <option value="Kg">Kg</option>
                </select>

            </div>
            <div class="form-group">
                <label for="supplier">Supplier:</label>
                <select name="supplier" class="custom-select">
                    <option selected>Chọn nhà cung cấp</option>
                    <option value="1">Công ty abc</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" class="custom-select">
                    <option selected>Chọn loại sản phẩm</option>
                    <option value="1">Cat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price')}}">
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" value="{{ old('image')}}">
            </div>
            <div class="form-group">
                <label for="active">Status:</label>
                <select name="active" class="custom-select">
                    <option selected>Chọn loại sản phẩm</option>
                    <option value="1">Còn hàng</option>
                    <option value="2">Hết hàng</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

@endsection
