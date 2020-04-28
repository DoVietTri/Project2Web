@extends('admin.master')
@section('title', 'Order List')
@section('controller', 'Đơn đặt hàng')
@section('action', 'List')

@section('content')

<div class="card-body">
    <div class="table-responsive">
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
                            @else
                                <a href="" class="badge badge-success">Đã xử lý</a>
                            @endif        
                        </td>
                        <td>
                            <a href="{!! route('admin.order.delete', $val->id) !!}" type="button" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
                            <button class="btn btn-info view_info_order" data-toggle="modal" data-target="#view_order_detail"><i class="fas fa-eye"></i></button>
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
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>nike</td>
                        <td>123</td>
                        <td>456</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection()