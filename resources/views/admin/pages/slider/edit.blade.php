@extends('admin.master')

@section('title', 'Slider Edit')
@section('controller', 'Slider')
@section('action', 'Edit')

@section('content')
<div class="row" style="margin: 5px">
    <div class="col-lg-12">
        <form action="{{ route('admin.slider.postEdit', $slider->id) }}" method="POST" enctype="multipart/form-data">

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
                <input type="text" class="form-control" value="{!! old('txtSlider', $slider->name) !!}" placeholder="Vui lòng nhập tên slider" name="txtSlider">
                 @if ($errors->first('txtSlider'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('txtSlider') }}
                        </ul>
                    </div>
                @endif
            </fieldset>
            <fieldset class="form-group">
                <label>Hình ảnh hiện tại</label>
                <img style="height: 90px;" src="{!! asset('resources/upload/slider/'.$slider->image) !!}">
                <label>Hình ảnh thay thế</label>
                <input type="file" name="fImage">
                 @if ($errors->first('fImage'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('fImage') }}
                        </ul>
                    </div>
                @endif
            </fieldset>
            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    </div>
</div>
@endsection()