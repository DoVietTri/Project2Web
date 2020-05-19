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
            </tr>
       @endforeach
    </tbody>
</table>