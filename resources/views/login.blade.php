@extends('main')
@section('content')
    <h2 class="text-danger text-center">Đăng nhập hệ thống</h2>
    @include('admin.alert')
    <div class="row">
        <div class="col-md-7">
            <img src="/images/login.png" class="img w-100">
        </div>
        <div class="col-md-5 my-auto">
            <form method="post" action="/login">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group row p-3">
                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>
                <a href="/register" class="text-success">Tạo người dùng mới</a>
                <br>
                <a href="/forgot-password" class="text-info">Quên mật khẩu</a>
            </form>
        </div>
    </div>
@endsection
