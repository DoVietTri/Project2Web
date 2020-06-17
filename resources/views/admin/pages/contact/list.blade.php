@extends('admin.master')
@section('title', 'Liên hệ')
@section('controller', 'Liên hệ')
@section('action', 'List')

@section('content')
<div class="card-body">
    
    <form action="" method="get">
        <select id="statusMessage" name="" style="width: 250px; height: 30px">
            <option value="2">Lọc tin nhắn....</option>
            <option value="0">Chưa đọc</option>
            <option value="1">Đã đọc</option>
        </select>
    </form>
    
    <br>
    <div class="table-responsive content_contact">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên khách hàng</th>
                    <th>Tin nhắn</th>
                    <th>Trạng thái</th>
                    <th>Xóa</th>
                    <th>Phản hồi</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 0; ?>
                @foreach($contact as $val)
                    <tr>
                        <td>{{ $stt += 1 }}</td>
                        <td>{{ $val->user->name }}</td>
                        <td>{{ $val->message }}</td>
                        <td>
                            @if ($val->status == 0)
                                <b>Chưa đọc</b>
                            @else
                                Đã đọc
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.contact.getDelete', $val->id) }}" class="btn btn-danger" onclick="return confirmDelete('Bạn có chắc chắn muốn xóa không ?')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td>
                            <button data-toggle="modal" data-target="#feedback" href="#" class="btn btn-info feedback"><i class="fas fa-eye"></i></button>
                        </td>
                    </tr>
                @endforeach    
            </tbody>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên khách hàng</th>
                    <th>Tin nhắn</th>
                    <th>Trạng thái</th>
                    <th>Xóa</th>
                    <th>Xem chi tiết</th>
                </tr>
            </tfoot>
        </table>
        <div class="product-pagination text-center" style="float: right;">
            <nav>
               
            </nav>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="feedback" aria-labelledby="feedback" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Phản hồi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
           <div class="content">
               
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection()
