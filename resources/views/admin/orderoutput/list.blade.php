@extends('admin.main')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Danh sách đơn hàng nhập</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-hovers">
                        <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày lập đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Nhân viên thực hiện</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders_output as $o)
                            <tr>
                                <td><a href="/admin/orders-output/edit/{{ $o->id }}">{{ $o->id }}</a></td>
                                <td>{{ $o->created_at }}</td>
                                <td>{{ $o->employee->name }}</td>
                                <td>{{ $o->employee->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
