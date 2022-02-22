@extends('main')
@section('content')
@include('admin.alert')
    <h1 class="text-center text-danger">Đăng ký người dùng mới</h1>
    <div class="row pt-5">
        <div class="col-md-7">
            <img src="/images/register.png" class="img w-100">
        </div>
        <div class="col-md-5 my-auto">
            <form method="POST" action="/register">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Họ và Tên:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation:</label>
                    <input type="password" class="form-control" id="password_confirmation"
                           name="password_confirmation">
                </div>
                <div class="form-group">
                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
