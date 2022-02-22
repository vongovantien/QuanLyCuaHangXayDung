@extends('admin.main')
@section('content')

    <div class="container p-5">
        <h3>Tạo đơn hàng nhập kho</h3>
        @include('admin.alert')
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <p>Thông tin khách hàng</p>
                    <div class="form-group">
                        <label for="name">Khách hàng:</label>
                        <select name="supplier" class="custom-select">
                            @foreach($customer as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <p>Thông tin nhân viên</p>
                    <div class="form-group">
                        <label for="name">Nhân viên:</label>
                        <input type="text" class="form-control" placeholder="Enter description" id="description"
                               name="description">
                    </div>
                </div>
            </div>


            <p>Thông tin sản phẩm</p>
            <div class="form-group">
                <label for="description">Sản phẩm:</label>
                <select name="product" class="custom-select">
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
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
                <label for="description">Số lượng:</label>
                <input type="text" class="form-control" placeholder="Nhập số lượng" id="description"
                       name="description" value="{{ old('description')}}">
            </div>
            <div class="form-group">
                <label for="description">Giá tiền:</label>
                <input type="text" class="form-control" placeholder="Nhập giá tiền" id="description"
                       name="description" value="{{ old('description')}}">
            </div>
            <button type="submit" class="btn btn-primary">Xuất hàng</button>
        </form>
    </div>

@endsection
