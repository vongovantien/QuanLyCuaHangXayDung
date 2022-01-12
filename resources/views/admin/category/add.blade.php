@extends('admin.main')
@section('content')

<div class="container p-5">
    <h3>Thêm mới loại sản phẩm</h3>
    @include('admin.alert')
    <form method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Category name:</label>
          <input type="text" class="form-control" placeholder="Enter your product name" id="name" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <input type="text" class="form-control" placeholder="Enter description" id="description" name="description" value="{{ old('description')}}">
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
