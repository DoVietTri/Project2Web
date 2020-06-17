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
        @foreach($filter as $val)
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