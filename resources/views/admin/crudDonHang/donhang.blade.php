<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn hàng</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .search-container {
            margin-bottom: 20px;
        }

        #searchInput {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #searchButton {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #searchButton:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <header>
        <h1>Trang chủ ADMIN</h1>
        <a href="{{ url('/') }}"><i class="fa fa-home" style="color:#fff; font-size: 25px;"></i></a>
        <nav>
            <ul>
                <li><a href="{{ asset('admin/listpro') }}">Quản lý sản phẩm</a></li>
                <li><a href="{{ asset('admin/listcate') }}">Danh Mục</a></li>
                <li><a href="{{ asset('admin/listUser') }}">Quản lý tài khoản</a></li>
                <li><a href="{{ asset('admin/donhang') }}">Đơn Hàng</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="admin-section">
            <h2>Quản lý Đơn hàng</h2>

            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Tìm kiếm theo ID người dùng hoặc sản phẩm...">
                <button type="button" id="searchButton">Tìm kiếm</button>
            </div>

            @isset($donhangs)
                @if ($donhangs->count())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Tên người nhận</th>
                                <th>Địa chỉ giao hàng</th>
                                <th>Số điện thoại</th>
                                <th>Ghi chú</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donhangs as $dh)
                                <tr>
                                    <td>{{ $dh->donhang_id }}</td>
                                    <td>{{ $dh->user_id }}</td>
                                    <td>{{ $dh->sanpham_id }}</td>
                                    <td>{{ $dh->soluong }}</td>
                                    <td>{{ $dh->ngaydat }}</td>
                                    <td>{{ number_format($dh->tongtien, 0, ',', '.') }} VND</td>
                                    <td>{{ $dh->ten }}</td>
                                    <td>{{ $dh->diachigiaohang }}</td>
                                    <td>{{ $dh->sdt }}</td>
                                    <td>{{ $dh->ghichudonhang }}</td>
                                    <td>{{ $dh->created_at }}</td>
                                    <td>{{ $dh->updated_at }}</td>
                                    <td>
                                    >
                                        <a href="{{ route('admin.donhang.show', $dh->donhang_id) }}"
                                            class="btn btn-info" >Xem</a>
                                        <form action="{{ route('admin.donhang.delete', $dh->donhang_id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Xóa đơn hàng này?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Không có đơn hàng nào.</p>
                @endif
            @endisset

            {{ $donhangs->links() }}
        </section>
    </main>
</body>
<script>
    // Hàm loại bỏ dấu tiếng Việt
    function removeVietnameseTones(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(/Đ/g, "D");
    }

    // Hàm tìm kiếm đơn hàng
    function searchOrders() {
        const searchKeyword = removeVietnameseTones(document.getElementById('searchInput').value.toLowerCase());
        const rows = document.querySelectorAll(".table tbody tr");
        let found = false;

        rows.forEach(function(row) {
            const userId = removeVietnameseTones(row.cells[1].textContent.toLowerCase());
            const productId = removeVietnameseTones(row.cells[2].textContent.toLowerCase());

            if (userId.includes(searchKeyword) || productId.includes(searchKeyword)) {
                row.style.display = '';
                found = true;
            } else {
                row.style.display = 'none';
            }
        });

        if (!found) {
            alert("Không tìm thấy đơn hàng phù hợp với từ khóa tìm kiếm.");
        }
    }

    // Gắn sự kiện click cho nút tìm kiếm
    document.addEventListener("DOMContentLoaded", function () {
        const searchButton = document.getElementById("searchButton");
        if (searchButton) {
            searchButton.addEventListener("click", searchOrders);
        }
    });
</script>

<script src="{{ asset('js/admin.js') }}"></script>

</html>