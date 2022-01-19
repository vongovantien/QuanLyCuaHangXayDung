@extends('admin.main')
@section('content')

    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-hovers">
                <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá tiền</th>
                    <th>Ngày nhập hàng</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($record as $o)
                    <tr>
                        <td>{{$o ->product->id}}</td>
                        <td>{{$o ->product->name}}</td>
                        <td>{{ $o->quantity }}</td>
                        <td> {{  number_format($o->price, 0)}} </td>
                        <td>{{ $o->created_at->format('d-m-Y')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
