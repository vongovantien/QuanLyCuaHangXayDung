@extends('admin.main')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Danh sách nhà cung cấp</h1>
            <meta name="csrf-token" content="{{ csrf_token() }}"/>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 mb-3">
                <div class="input-group">
                    <input class="form-control" value="{{ old('kw') }}" type="text" placeholder="Search for..."
                           aria-label="Search for..." aria-describedby="btnNavbarSearch" name="kw"/>
                    <button class="btn btn-primary mb-3" id="btnNavbarSearch" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-hovers">
                        <thead>
                        <tr>
                            <th>Mã nhà cung cấp</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($suppliers as $s)
                            <tr>
                                <td>{{ $s->id }}</td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->email }}</td>
                                <td>{{ $s->phone }}</td>
                                <td>
                                    <a href="/admin/suppliers/edit/{{$s->id}}" class="btn btn-info btn-circle btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm"
                                       onclick="deleteRow('{{ $s->id }}', '/admin/suppliers/delete')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
