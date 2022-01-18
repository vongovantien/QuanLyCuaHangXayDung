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
                <label for="active">Loại sản phẩm:</label>
                <select class="custom-select" name="category">
                    <option selected>Chọn loại sản phẩm</option>
                    @foreach($cates as $c)
                        <option value="{{ $c->id }}">
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="supplier">Supplier:</label>
                <select name="supplier" class="custom-select">
                    <option selected>Chọn nhà cung cấp</option>
                    @foreach($supplier as $s)
                        <option value="{{ $s->id }}">
                            {{ $s->name }}
                        </option>
                    @endforeach
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
            <div class="my-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" id="active" value="active">
                    <label class="form-check-label" for="active">Còn hàng</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" id="active" value="active">
                    <label class="form-check-label" for="active">Hết hàng</label>
                </div>
            </div>
            <div class="col">
                <input type="submit" class="btn btn-primary" value="Create"/>
            </div>

        </form>
    </div>

@endsection
