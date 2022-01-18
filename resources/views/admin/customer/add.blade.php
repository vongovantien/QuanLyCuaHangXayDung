@extends('admin.main')
@section('content')

    <div class="container p-5">
        <h3>Thêm mới sản phẩm</h3>
        @include('admin.alert')
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Tên khách hàng:</label>
                <input type="text" class="form-control" placeholder="Nhập tên khách hàng" id="name" name="name"
                       value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" class="form-control" placeholder="Nhập địa chỉ khách hàng" id="address"
                       name="address" value="{{ old('address')}}">
            </div>
            <button type="submit" class="btn btn-danger">Create and continue</button>
            <button type="submit" class="btn btn-primary" name="back">Create new</button>
        </form>
    </div>

@endsection
