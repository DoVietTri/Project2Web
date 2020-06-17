@extends('admin.master')
@section('title', 'Slider List')
@section('controller', 'Slider')
@section('action', 'List')

@section('content')
<div style="margin: 0 auto; margin-top: 20px">
    <a href="#" class="btn btn-primary">Export to Excel</a>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên slider</th>
                    <th>Hình ảnh</th>
                    <th>Xóa</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên slider</th>
                    <th>Hình ảnh</th>
                    <th>Xóa</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </tfoot>
            <tbody>
            	<?php $stt = 0?>
            	@foreach($slider as $val)
                <tr>
                    <td>{!! $stt = $stt + 1 !!}</td>
                    <td>{!! $val->name !!}</td>
                    <td>
                        <img style="height: 70px;" src="{!! asset('resources/upload/slider/'.$val->image) !!}">
                    </td>
                    <td>           
                        <a type="button" class="btn btn-danger" onclick="return confirmDelete('Bạn có chắc chắn muốn xóa không ?')" href="{!! route('admin.slider.getDelete', $val->id) !!}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    <td>
                    	<a type="button" class="btn btn-warning" href="{!! route('admin.slider.getEdit', $val->id) !!}"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection()