@extends('admin.main')
@section('content')

    <div class="container p-5">
        <h3>Cập nhật nhân viên</h3>
        @include('admin.alert')
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Username:</label>
                <input type="text" class="form-control" placeholder="Enter your username" id="name" name="name"
                       value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="description">Email:</label>
                <input type="text" class="form-control" placeholder="Enter email" id="email"
                       name="email" value="{{$user->email}}">
            </div>
            <h4>Vai trò</h4>
            <p>Gán vai trò cho nhân viên</p>
            <div class="form-group">
                <label for="role">Vai trò:</label>
                <select name="role" class="custom-select">
                    @foreach($roles as $r)
                        <option value="{{ $r->id }}" {{ $user->role_id == $r->id ? 'selected' : '' }}>
                            {{ $r->name }}
                        </option>
                    @endforeach
                </select>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="role">Vai trò:</label>--}}
{{--                <select name="role" class="custom-select">--}}
{{--                    @foreach($roles as $r)--}}
{{--                        <option value="{{ $r->id }}" {{ $user->role_id == $r->id ? 'selected' : '' }}>--}}
{{--                            {{ $r->name }}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

@endsection
