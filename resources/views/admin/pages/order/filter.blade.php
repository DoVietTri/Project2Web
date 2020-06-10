
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
            @foreach($filter as $val)
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
