@extends('admin.master')

@section('title', 'User Add')
@section('controller', 'User')
@section('action', 'Add')

@section('content')
<div class="row" style="margin: 5px">
    <div class="col-lg-12">
        <form action="{{ route('admin.user.postAdd') }}" method="POST">

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <fieldset class="form-group">
                <label>Tên người dùng</label>
                <input type="text" class="form-control" placeholder="Vui lòng nhập tên" name="txtUsername">
            </fieldset>
            <fieldset class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" placeholder="Vui lòng nhập email " name="txtEmail">
            </fieldset>
            <fieldset class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" placeholder="Vui lòng nhập mật khẩu " name="txtPass">
            </fieldset>
            <fieldset class="form-group">
                <label>Nhập lại mật khẩu</label>
                <input type="password" class="form-control" placeholder="Vui lòng nhập lại mật khẩu " name="txtSamePass">
            </fieldset>

            <div class="form-group">
                <label>Quyền truy cập</label>

                <select class="form-control" name="rdoRuler">
                    @if (Auth::user()->ruler == 1)
                        <option value="1">Admin</option>
                        <option value="0">Người dùng</option>
                        <option value="2">Cộng tác viên</option>
                    @elseif (Auth::user()->ruler == 2)
                        <option value="0">Người dùng</option>
                        <option value="2">Cộng tác viên</option>
                    @endif    
                </select>
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
            <button type="reset" class="btn btn-primary">Làm mới</button>
        </form>
    </div>
</div>
@endsection()