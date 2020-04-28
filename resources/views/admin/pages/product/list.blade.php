@extends('admin.master')
@section('title', 'Product List')
@section('controller', 'Product')
@section('action', 'List')

@section('content')

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh đại diện</th>
                    <th>Thông tin sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Xóa</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh đại diện</th>
                    <th>Thông tin sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Xóa</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </tfoot>
            <tbody>
            	<?php $stt = 0?>
            	@foreach($product as $value)
                <tr>
                    <td>{!! $stt = $stt + 1 !!}</td>
                    <td>{!! $value->name !!}</td>
                    <td>
                        <img style="height: 70px;" src="{!! asset('resources/upload/'.$value->image) !!}">
                    </td>
                    <td>
                        Số lượng: {!! $value->quantity !!}
                        <br>
                        Đơn giá: {!! number_format($value->price, 0, ",", ".") !!} VNĐ
                        <br>
                        Giá khuyến mại: {!! number_format($value->promotional, 0, ",", ".") !!} VNĐ
                    </td>
                    <td>
                        @if($value->status == 1)
                            Hiển thị
                        @else
                            Không hiển thị
                        @endif
                    </td>
                    <td>           
                        <a type="button" class="btn btn-danger" onclick="return confirmDelete('Bạn có chắc chắn muốn xóa không ?')" href="{!! route('admin.product.getDelete', $value->id) !!}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    <td>
                    	<a type="button" class="btn btn-warning" href="{!! route('admin.product.getEdit', $value->id) !!}"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="product-pagination text-center" style="float: right;">
            <nav>
                {!! $product->links() !!}
            </nav>
        </div>
    </div>
</div>

@endsection()