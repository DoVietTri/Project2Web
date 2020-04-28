@extends('admin.master')
@section('title', 'User List')
@section('controller', 'User')
@section('action', 'List')

@section('content')

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Quyền truy cập</th>
                    <th>Xóa</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Quyền truy cập</th>
                    <th>Xóa</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </tfoot>
            <tbody>
            	<?php $stt = 0?>
            	@foreach($user as $val)
                <tr>
                    <td>{!! $stt = $stt + 1 !!}</td>
                    <td>{!! $val->name !!}</td>
                    <td>{!! $val->email !!}</td>
                    <td>
                        @if ($val->ruler == 1) 
                            Admin 
                        @elseif($val->ruler == 0)
                            Người dùng
                        @elseif ($val->ruler == 2)
                            Cộng tác viên
                        @endif
                    </td>
                    <td>
                        <a onclick="confirmDelete('Bạn có chắc chắn xóa thành viên này ?')" type="button" href="{!! route('admin.user.getDelete', $val->id) !!}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    <td>
                        <a type="button" href="{!! route('admin.user.getEdit', $val->id) !!}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection()