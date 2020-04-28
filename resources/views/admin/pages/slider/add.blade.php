@extends('admin.master')

@section('title', 'Slider Add')
@section('controller', 'Slider')
@section('action', 'Add')

@section('content')
<div class="row" style="margin: 5px">
    <div class="col-lg-12">
        <form action="{{ route('admin.slider.postAdd') }}" method="POST" enctype="multipart/form-data">

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
                <label>Tên slider</label>
                <input type="text" class="form-control" placeholder="Vui lòng nhập tên slider" name="txtSlider">
            </fieldset>
            <fieldset class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="fImage">
            </fieldset>
            <button type="submit" class="btn btn-success">Thêm</button>
            <button type="reset" class="btn btn-primary">Làm mới</button>
        </form>
    </div>
</div>
@endsection()