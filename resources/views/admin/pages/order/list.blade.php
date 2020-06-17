@extends('admin.master')
@section('title', 'Order List')
@section('controller', 'Đơn đặt hàng')
@section('action', 'List')

@section('content')
<div style="margin: 0 auto; margin-top: 20px">
    <a href="{{ route('admin.order.export') }}" class="btn btn-primary">Export to Excel</a>
</div>
<div class="card-body">
    
    <form action="" method="get">
        <select  id="statusOrder" name="" style="width: 250px; height: 30px">
            <option value="3">Lọc trạng thái đơn hàng...</option>
            <option value="0">Chờ xử lý</option>
            <option value="1">Đang giao hàng</option>
            <option value="2">Đã xử lý</option>
        </select>
    </form>
    
    <br>
    <div class="table-responsive content_filter">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Thông tin khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Thông tin khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </tfoot>
            <tbody>
                <?php $stt = 0?>
                @foreach($order as $val)
                    <tr>
                        <td>{!! $stt += 1 !!}</td>
                        <td>
                            <li>Tên khách hàng:  {!! $val->name !!}</li>
                            <li>Địa chỉ: {!! $val->address !!}</li>
                            <li>Số điện thoại: {!! $val->phone !!}</li>
                        </td>
                        <td>{!! number_format($val->money, 0, ",", ".") !!} VNĐ</td>
                        <td>
                    
                            @if ($val->status == 0)
                                <a href="" class="badge badge-secondary">Chờ xử lý</a>
                            @elseif ($val->status == 1)
                                <a href="" class="badge badge-info">Đang giao hàng </a>
                            @elseif ($val->status == 2)
                                <a href="" class="badge badge-success">Đã xử lý</a>
                            @endif        
                        </td>
                        <td>
                            <a href="{!! route('admin.order.delete', $val->id) !!}" type="button" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
                            <a href="{!! route('admin.order.getOrderDetail', $val->id) !!}" type="button" class="btn btn-info"><i class="fas fa-eye"></i></a>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="product-pagination text-center" style="float: right;">
            <nav>
                {!! $order->links() !!}
            </nav>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="view_order_detail" aria-labelledby="view_order_detail" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Chi tiết đơn hàng</h5>
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
