@extends('admin.main')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Danh sách sản phẩm</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-hovers">
                        <thead>
                        <tr>
                            <th>Mã loại sản phẩm</th>
                            <th>Tên loại sản phẩm</th>
                            <th>Miêu tả</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cates as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>
                                    <form action="" method="get">

                                    </form>
                                    {{ $c->name }}
                                </td>
                                <td>{{ $c->description }}</td>
                                <td>
                                    @if ( $c->active == 1)
                                        Còn hàng
                                    @else
                                        Hết hàng
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-circle btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $cates->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
