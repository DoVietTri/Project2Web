
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $val)
        <tr>
            <td>{!! $val->product->name !!}</td>
            <td>
                <img src="{!! asset('resources/upload/'.$val->product->image) !!}" style="height: 70px">
            </td>
            <td>{!! number_format($val->price, 0, ",", ".")!!}</td>
            <td>{!! $val->quantity !!}</td>
            <td>{!! number_format($val->price*$val->quantity, 0, ",", "." ) !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
