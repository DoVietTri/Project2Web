@extends('admin.master')

@section('title', 'Slider Add')
@section('controller', 'Slider')
@section('action', 'Add')

@section('content')
<div class="row" style="margin: 5px">
    <div class="col-lg-12">
        <form action="{{ route('admin.slider.postAdd') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <fieldset class="form-group">
                <label>Tên slider</label>
                <input type="text" class="form-control" placeholder="Vui lòng nhập tên slider" name="txtSlider">
                @if ($errors->first('txtSlider'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('txtSlider') }}
                        </ul>
                    </div>
                @endif
            </fieldset>
            <fieldset class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="fImage">
                @if ($errors->first('fImage'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('fImage') }}
                        </ul>
                    </div>
                @endif
            </fieldset>
            <button type="submit" class="btn btn-success">Thêm</button>
        </form>
    </div>
</div>
@endsection()