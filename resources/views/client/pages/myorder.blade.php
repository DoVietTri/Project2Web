@extends('client.master')
@section('title', 'Quản lý đơn hàng')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Quản lý đơn hàng</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
	<div class="row">
		<table class="shop_table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày mua</th>        
                    <th>Tổng tiền</th>
                    <th>Trạng thái đơn hàng</th>
                </tr>
            </thead>
            <tbody>
            	@foreach($order as $val)

                    @if ($val->status == 2)
                            <tr>
                                <td>
                                    <button class="btn btn-info view_info_order_detail" id="{!! $val->id !!}" data-toggle="modal" data-target="#view_order_detail_1"><s>{!! $val->code_order !!}</s></button>
                                </td>
                                <td><s>{!! $val->created_at !!}</s></td>
                            
                                <td><s>{!! number_format($val->money, 0, ",", ".") !!} VNĐ</s></td>
                                <td>
                                    <s>
                                        @if ($val->status == 0)
                                        Chờ xử lý
                                        @elseif($val->status == 1)
                                            Đang giao hàng
                                        @elseif($val->status == 2)
                                            Đã xử lý
                                        @endif   
                                    </s>   
                                </td>
                            </tr>
                        
                    @else
                        <tr>
                            <td>
                                <button class="btn btn-info view_info_order_detail" id="{!! $val->id !!}" data-toggle="modal" data-target="#view_order_detail_1">{!! $val->code_order !!}</button>
                            </td>
                            <td>{!! $val->created_at !!}</td>
                        
                            <td>{!! number_format($val->money, 0, ",", ".") !!} VNĐ</td>
                            <td>
                                @if ($val->status == 0)
                                    Chờ xử lý
                                @elseif($val->status == 1)
                                    Đang giao hàng
                                @elseif($val->status == 2)
                                    Đã xử lý
                                @endif      
                            </td>
                        </tr>
                    @endif
                	
            	@endforeach
            </tbody>
            <tfoot>
            	<tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày mua</th>                  
                    <th>Tổng tiền</th>
                    <th>Trạng thái đơn hàng</th>
                </tr>
            </tfoot>
        </table>
	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="view_order_detail_1">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
@endsection