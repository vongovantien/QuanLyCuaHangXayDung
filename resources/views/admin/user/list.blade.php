@extends('admin.main')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Danh sách người dùng</h1>
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
                            <th>Email</th>
                            <th>Tên người dùng</th>
                            <th>Trạng thái</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Ngày tạo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $u)
                            <tr>
                                <td><a href="/admin/users/edit/{{ $u->id }}">{{ $u->email }}</a></td>
                                <td>{{ $u->name }}</td>
                                <td>
                                    @if ( $u->active == 1)
                                        Đang hoạt động
                                    @else
                                        Chưa hoạt động
                                    @endif</td>
                                <td>dịa chi</td>
                                <td>
                                    so đt
                                </td>
                                <td>
                                    {{$u->created_at}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->withQueryString('quantity', 'filter')->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
