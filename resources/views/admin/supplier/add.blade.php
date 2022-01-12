@extends('admin.main')
@section('content')

    <div class="container p-5">
        <h3>Thêm mới nhà cung cấp</h3>
        @include('admin.alert')
        <form method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name of Supplier:</label>
                <input type="text" class="form-control" placeholder="Enter the name of the supplier" id="name"
                       name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="description">Email:</label>
                <input type="email" class="form-control" placeholder="Enter the email of the supplier" id="email"
                       name="email" value="{{ old('email')}}">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" placeholder="Enter the address of the supplier" id="address"
                       name="address" value="{{ old('address')}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" placeholder="Enter the phone of the supplier" id="phone"
                       name="phone" value="{{ old('phone')}}">
            </div>
            <button type="submit" class="btn btn-danger">Create and continue</button>
            <button type="submit" class="btn btn-primary" name="back">Create new</button>
        </form>
    </div>
@endsection
