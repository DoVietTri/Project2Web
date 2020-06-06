@extends('admin.master')
@section('title', 'Đơn hàng')
@section('controller', 'Đơn hàng chi tiết')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div>
            <ul>
                <li>Mã đơn hàng: {!! $info->code_order !!} </li>
                <li>Tên khách hàng: {!! $info->name !!}</li>
                <li>Số điện thoại: {!! $info->phone  !!}</li>
                <li>Địa chỉ: {!! $info->address !!}</li>         
            </ul>
            
        </div>
        <form action="{!! route('admin.order.postOrderDetail',  $info->id) !!}" method="post">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h5>Trạng thái đơn hàng</h5>
                <select name="transaction" style="width: 300px; height: 37px; margin-top: 10px">
                    <option value="0">Chờ xử lý</option>
                    <option value="1">Đang giao hàng</option>
                    <option value="2">Đã xử lý</option>
                </select>
                <input type="submit" class="btn btn-primary" value="Lưu">
        </form>
        <div style="margin-top: 5px">
            <a class="btn btn-primary" href="{!! route('admin.order')  !!}">Quay lại</a>
        </div>
    </div>
    <div class="col-lg-8">
         <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh đại diện</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 0?>
                @foreach($order as $val)
                <tr>
                    <td>{!! $stt += 1 !!}</td>
                    <td>{!! $val->product->name !!}</td>
                    <td>
                        <img src="{!! asset('resources/upload/'.$val->product->image) !!}" style="height: 70px">
                    </td>
                    <td>
                        {!! number_format($val->price, 0, ",", ".") !!} VNĐ
                    </td>
                    <td>{!! $val->quantity !!}</td>
                    <td>{!! number_format($val->price*$val->quantity, 0, ",", ".") !!} VNĐ</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh đại diện</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </tfoot>
            <tbody>
                
            </tbody>
        </table>
        <div class="product-pagination text-center" style="float: right;">
            <nav>
                
            </nav>
        </div>
    </div>
    </div>
</div>
@endsection
