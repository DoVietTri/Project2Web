@extends('admin.master')
@section('title', 'Category List')
@section('controller', 'Category')
@section('action', 'List')

@section('content')

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Tên không dấu</th>
                    <th>Xóa</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Tên không dấu</th>
                    <th>Xóa</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </tfoot>
            <tbody>
            	<?php $stt = 0?>
            	@foreach($category as $value)
                <tr>
                    <td>{!! $stt = $stt + 1 !!}</td>
                    <td>{!! $value->name !!}</td>
                    <td>{!! $value->alias !!}</td>
                    <td>           
                        <a class="btn btn-danger" onclick="return confirmDelete('Bạn có chắc chắn muốn xóa không ?')" href="{!! route('admin.category.getDelete', $value->id) !!}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    <td>
                    	<a class="btn btn-warning" href="{!! route('admin.category.getEdit', $value->id) !!}"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="product-pagination text-center" style="float: right;">
        <nav>
            {!! $category->links() !!}
        </nav>
    </div>
</div>

@endsection()