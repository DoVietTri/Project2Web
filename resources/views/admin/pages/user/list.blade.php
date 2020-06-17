@extends('admin.master')
@section('title', 'User List')
@section('controller', 'User')
@section('action', 'List')

@section('content')
<div style="margin: 0 auto; margin-top: 20px">
    <a href="{{ route('admin.user.excel') }}" class="btn btn-primary">Export to Excel</a>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Quyền truy cập</th>
                    <th>Trạng thái</th>
                    <th>Xóa</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Quyền truy cập</th>
                    <th>Trạng thái</th>
                    <th>Xóa</th>
                    <th>Hành động</th>
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
                        @if ($val->status == 0)
                            Khả dụng
                        @elseif ($val->status == 1)
                            Đã bị khóa
                        @endif
                    </td>
                    <td>
                        <a onclick="confirmDelete('Bạn có chắc chắn xóa thành viên này ?')" type="button" href="{!! route('admin.user.getDelete', $val->id) !!}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    @if ($val->status == 0)
                        <td>
                            <a onclick="confirmDelete('Bạn có chắc chắn muốn khóa tài khoản này không ?')" type="button" href="{{ route('admin.user.getLock', $val->id) }}" class="btn btn-warning"><i class="fas fa-key"></i></i></a>
                        </td>
                    @elseif ($val->status == 1)
                        <td>
                            <a onclick="confirmDelete('Bạn có chắc chắn muốn mở khóa thành viên này không ?')" type="button" href="{{ route('admin.user.getUnlock', $val->id) }}" class="btn btn-warning"><i class="fas fa-unlock"></i></a>
                        </td>
                    @endif
                   <!--  <td>
                        <a type="button" href="#" class="btn btn-warning"><i class="fas fa-key"></i></i></a>
                    </td>
                    <td>
                        <a type="button" href="#" class="btn btn-warning"><i class="fas fa-unlock"></i></a>
                    </td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection()