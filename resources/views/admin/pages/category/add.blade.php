@extends('admin.master')

@section('title', 'Category Add')
@section('controller', 'Category')
@section('action', 'Add')

@section('content')
<div class="row" style="margin: 5px">
    <div class="col-lg-12">
        <form action="{{ route('admin.category.postAdd') }}" method="POST">

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
                <label>Tên danh mục</label>
                <input type="text" class="form-control" placeholder="Vui lòng nhập tên danh mục" name="txtCateName">
            </fieldset>
            <button type="submit" class="btn btn-success">Thêm</button>
            <button type="reset" class="btn btn-primary">Làm mới</button>
        </form>
    </div>
</div>
@endsection()