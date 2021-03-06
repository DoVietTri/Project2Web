@extends('admin.master')

@section('title', 'Product Add')
@section('controller', 'Product')
@section('action', 'Add')

@section('content')
<div class="row" style="margin: 5px">
    <div class="col-lg-12">
        <form action="{{ route('admin.product.postAdd') }}" method="POST" enctype="multipart/form-data">

           <!--  @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="form-group">
                    <label>Danh mục</label>
                    <select class="form-control" name="txtCateName">
                        @foreach($category as $value)
                            <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                        @endforeach
                    </select>   
                </div>
            <fieldset class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control" placeholder="Vui lòng nhập tên sản phẩm" name="txtProductName">
                @if($errors->first('txtProductName'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('txtProductName') }}
                        </ul>
                        <!-- <small class="form-text invalid-feedback" style="color: red">{{ $errors->first('txtProductName') }}</small> -->
                    </div>
                @endif
            </fieldset>
            <fieldset class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" name="nquantity" min="1" value="1" class="form-control">
                @if($errors->first('nquantity'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('nquantity') }}
                        </ul>
                        <!-- <small class="form-text invalid-feedback" style="color: red">{{ $errors->first('nquantity') }}</small> -->
                    </div>
                @endif
            </fieldset>
            <fieldset class="form-group">
                <label>Đơn giá</label>
                <input type="text" class="form-control" placeholder="Vui lòng nhập đơn giá" name="txtPrice">
                @if($errors->first('txtPrice'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('txtPrice') }}
                        </ul>
                        <!-- <small class="form-text invalid-feedback" style="color: red">{{ $errors->first('txtPrice') }}</small> -->
                    </div>
                @endif
            </fieldset>
            <fieldset class="form-group">
                <label>Giá khuyến mại</label>
                <input type="text" class="form-control" placeholder="Nhập giá khuyến mại nếu có" name="txtPromotional">
            </fieldset>
            <fieldset class="form-group">
                <label>Hình ảnh đại diện</label>
                <input type="file" name="fImage">
                @if($errors->first('fImage'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('fImage') }}
                        </ul>
                        <!-- <small class="form-text invalid-feedback" style="color: red">{{ $errors->first('fImage') }}</small> -->
                    </div>
                @endif
            </fieldset>
            @for($i = 1; $i <= 3; $i = $i + 1)
            <fieldset class="form-group">
                <label>Hình ảnh chi tiết thứ {!! $i !!}</label>
                <input type="file" name="fImageDetail[]">
                @if($errors->first('fImageDetail'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('fImageDetail') }}
                        </ul>
                        <!-- <small class="form-text invalid-feedback" style="color: red">{{ $errors->first('fImageDetail') }}</small> -->
                    </div>
                @endif
            </fieldset>
            @endfor
            <fieldset class="form-group">
                <label>Mô tả</label>
                <textarea rows="3" class="form-control" name="txtDescription"></textarea>
            </fieldset>
            <div class="form-group">
                <label>Trạng thái</label>
                <select class="form-control" name="txtStatus">
                    <option value="1">Hiển thị</option>
                    <option value="2">Không hiển thị</option>
                </select>
                @if($errors->first('txtStatus'))
                    <div class="alert alert-danger">
                        <ul>
                            {{ $errors->first('txtStatus') }}
                        </ul>
                        <!-- <small class="form-text invalid-feedback" style="color: red">{{ $errors->first('txtProductName') }}</small> -->
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
        </form>
    </div>
</div>
@endsection()