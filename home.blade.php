<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>

    </style>
</head>

<body>

    <header>
        <h1>Trang chủ ADMIN</h1>
        <a href="{{ url('/') }}">
            <i class="fa fa-home" style="color:#fff; font-size: 25px;"></i>
        </a>

        <div style="display: flex; justify-content: center; margin-top: 10px;">
            <nav>
                <ul style="display: flex; list-style: none; gap: 20px; padding: 0; margin: 0;">
                    <li><a href="{{ asset('admin/listpro') }}" class="nav-link">Quản lý sản phẩm</a></li>
                    <li><a href="{{ asset('admin/listcate') }}" class="nav-link">Danh Mục</a></li>
                    <li><a href="{{ asset('admin/listUser') }}" class="nav-link">Quản lý tài khoản</a></li>
                    <li><a href="{{ asset('admin/donhang') }}">Đơn Hàng</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <div style="text-align: center; margin-top: 30px;">
    <img src="https://cdn-icons-png.flaticon.com/512/4712/4712107.png" alt="Robot chào" width="120" style="margin-bottom: 10px;">
    <h2 style="color: #333;">Chào mừng Admin quay lại 👋</h2>
    </div>


    <div style="display: flex; justify-content: center; gap: 30px; margin-top: 40px; flex-wrap: wrap;">

    <a href="{{ asset('admin/listpro') }}" style="text-decoration: none;">
        <div style="width: 220px; height: 150px; background-color: #3498db; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold; transition: 0.3s;">
            Quản lý sản phẩm
        </div>
    </a>

    <a href="{{ asset('admin/listcate') }}" style="text-decoration: none;">
        <div style="width: 220px; height: 150px; background-color: #2ecc71; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold; transition: 0.3s;">
            Danh Mục
        </div>
    </a>

    <a href="{{ asset('admin/listUser') }}" style="text-decoration: none;">
        <div style="width: 220px; height: 150px; background-color: #e67e22; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold; transition: 0.3s;">
            Quản lý tài khoản
        </div>
    </a>

    <a href="{{ asset('admin/donhang') }}" style="text-decoration: none;">
        <div style="width: 220px; height: 150px; background-color: #9b59b6; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold; transition: 0.3s;">
            Đơn Hàng
        </div>
    </a>

</div>

</body>

</html>