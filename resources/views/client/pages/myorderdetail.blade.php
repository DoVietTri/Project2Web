<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Số thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
      <?php $stt = 0 ?>
       @foreach($orders as $val)
       <tr>
          <td>{!! $stt = $stt + 1 !!}</td>
          <td>{!! $val->product->name !!}</td>
          <td><img style="height: 70px" src="{!! asset('resources/upload/'.$val->product->image) !!}"></td>
          <td>{!! number_format($val->price, 0, ",", ".") !!} VNĐ</td>
          <td>{!! $val->quantity !!}</td>
          <td>{!! number_format($val->price*$val->quantity, 0, ",", ".") !!} VNĐ</td>
       </tr>
       @endforeach
    </tbody>
</table>