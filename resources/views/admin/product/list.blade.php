@extends('admin.main')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Danh sách sản phẩm</h1>
            <meta name="csrf-token" content="{{ csrf_token() }}"/>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <form class="py-3">
                <div class="row">
                    <div class="col-md-3">
                        <input class="form-control" value="{{ old('kw') }}" type="text" placeholder="Search for..."
                               name="kw"/>
                    </div>
                    <div class="col-md-3">
                        <select class="custom-select" name="quantity">
                            <option value="">Hiển thị</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="custom-select" name="filter">
                            <option value="">Sắp xếp kết quả</option>
                            <option value="date">Sắp xếp tăng theo ngày tháng</option>
                            <option value="date_desc">Sắp xếp giảm theo ngày tháng</option>
                            <option value="name">Sắp xếp theo tên từ A - Z</option>
                            <option value="name_desc">Sắp xếp tên từ Z - A</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input class="btn btn-primary" type="submit" value="Filter"/>
                    </div>
                </div>
            </form>
            <div class="card mb-4">
                <div class="card-body table-reponsive">
                    <table class="table table-hovers ">
                        <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn vị tính</th>
                            <th>Loại sản phẩm</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->unit }}</td>
                                <td>{{ $p->category->name }}</td>
                                <td>
                                    @if ( $p->active == 1)
                                        Còn hàng
                                    @else
                                        Hết hàng
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/products/detail/{{$p->id}}" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="/admin/products/edit/{{$p->id}}" class="btn btn-info btn-circle btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm"
                                       onclick="deleteRow('{{ $p->id }}', '/admin/products/delete')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$products->withQueryString('quantity', 'filter')->links() }}
                </div>
            </div>
        </div>
        <a class="btn btn-warning" href="{{ route('export') }}">Export Product Data</a>
    </main>
@endsection
