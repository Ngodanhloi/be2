<!DOCTYPE html>
<html>

<head>
    <title>Chi tiết đơn hàng</title>
</head>

<body>
    <h1>Chi tiết đơn hàng #{{ $donhang->donhang_id }}</h1>

    <p><strong>ID:</strong> {{ $donhang->donhang_id }}</p>
    <p><strong>Người dùng:</strong> {{ $donhang->user->name ?? 'N/A' }}</p>
    <p><strong>Sản phẩm:</strong> {{ $donhang->sanpham->ten ?? 'N/A' }}</p>
    <p><strong>Số lượng:</strong> {{ $donhang->soluong }}</p>
    <p><strong>Ngày đặt:</strong> {{ $donhang->ngaydat }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($donhang->tongtien, 0, ',', '.') }} VND</p>
    <p><strong>Tên người nhận:</strong> {{ $donhang->ten }}</p>
    <p><strong>Địa chỉ giao hàng:</strong> {{ $donhang->diachigiaohang }}</p>
    <p><strong>Số điện thoại:</strong> {{ $donhang->sdt }}</p>
    <p><strong>Ghi chú:</strong> {{ $donhang->ghichudonhang }}</p>
    <p><strong>Ngày tạo:</strong> {{ $donhang->created_at }}</p>
    <p><strong>Ngày cập nhật:</strong> {{ $donhang->updated_at }}</p>

    <a href="{{ route('admin.donhang') }}">← Quay lại danh sách</a>
</body>

</html>