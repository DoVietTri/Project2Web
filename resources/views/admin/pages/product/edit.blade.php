@extends('admin.master')

@section('title', 'Product Edit')
@section('controller', 'Product')
@section('action', 'Edit')

@section('content')
<div class="row" style="margin: 5px">
    <div class="col-lg-12">
        <form name="frmEditProduct" action="{{ route('admin.product.postEdit', $product->id) }}" method="POST" enctype="multipart/form-data">

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
                <div class="form-group">
                    <label>Danh mục</label>
                    <select class="form-control" name="txtCateName"> 
                            @foreach($cate_detail as $val)        
                            <option value="{!! $val->id !!}">{!! $val->name !!}</option>
                            @endforeach                 
                    </select>   
                </div>
            <fieldset class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control" value="{!! old('txtProductName', $product->name) !!}" placeholder="Vui lòng nhập tên sản phẩm" name="txtProductName">
            </fieldset>
            <fieldset class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" name="nquantity" min="1" value="{!! old('nquantity', $product->quantity) !!}" class="form-control">
            </fieldset>
            <fieldset class="form-group">
                <label>Đơn giá</label>
                <input type="text" class="form-control" value="{!! old('txtPrice',$product->price) !!}" placeholder="Vui lòng nhập đơn giá" name="txtPrice">
            </fieldset>
            <fieldset class="form-group">
                <label>Giá khuyến mại</label>
                <input type="text" class="form-control" value="{!! old('txtPromotional',$product->promotional) !!}" placeholder="Nhập giá khuyến mại nếu có" name="txtPromotional">
            </fieldset>
            <fieldset class="form-group">
                <label>Hình ảnh đại diện</label>
                <img style="height: 150px;" src="{!! asset('resources/upload/'.$product->image) !!}" >
                <label style="margin-left: 30px;">Hình ảnh đại diện thay thế (nếu có)</label>
                <input type="file" name="fImage">
                <input type="hidden" name="img_current" value="{!! $product->image !!}">
            </fieldset>
            @foreach($product_img as $key => $item)
            <fieldset class="form-group">
                <label>Hình ảnh detail thứ {!! $key + 1 !!}</label>
                <img id="{!! $item->id !!}" style="height: 150px;" src="{!! asset('resources/upload/detail/'.$item['image']) !!}">
                <a style="position: relative; top: -60px; right: 30px" class="btn btn-danger delete_image_detail"><i class="fa fa-times"></i></a>
            </fieldset>
            @endforeach

            @for ($i = 1; $i <= 3; $i++) 
                <fieldset class="form-group">
                    <label>Hình ảnh chi tiết thứ {!! $i !!} (nếu có thay đổi)</label>
                    <input type="file" name="fImageDetail[]">
                </fieldset>
            @endfor

            <fieldset class="form-group">
                <label>Mô tả</label>
                <textarea rows="3" class="form-control" name="txtDescription">{!! old('txtDescription', $product->description) !!}</textarea>
            </fieldset>
            <div class="form-group">
                <label>Trạng thái</label>
                <select class="form-control" name="txtStatus">
                    <option value="1">Hiển thị</option>
                    <option value="2">Không hiển thị</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Sửa</button>
        </form>
    </div>
</div>
@endsection()