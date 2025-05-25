<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
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

<header>
    <h1>Trang chủ ADMIN</h1>
    <a href="{{url('/')}}"><i class="fa fa-home" style="color:#fff; font-size: 25px;"></i></a>
    <nav>
        <ul>
            <li><a href="{{asset('roleadmin/pro')}}" class="nav-link">Quản lý sản phẩm</a></li>
            <li><a href="{{asset('roleadmin/cate')}}" class="nav-link">Danh Mục</a></li>
            <li><a href="{{asset('roleadmin/user')}}" class="nav-link">Quản lý tài khoản</a></li>
            <li><a href="{{ asset('roleadmin/donhang') }}">Đơn Hàng</a></li>
        </ul>
    </nav>
</header>

<main>
    @if (session('success'))
    <div id="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <section id="accounts-section" class="admin-section">
        <h2>Quản lý tài khoản</h2>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Tìm kiếm theo tên người dùng...">
            <button type="button" id="searchButton">Tìm kiếm</button>
        </div>
        <!-- Button to trigger the popup -->
        <button id="openPopupButton" class="btn btn-primary">Thêm tài khoản</button>
        <!-- Popup form -->
        <div id="popupForm" style="display: none;">
            <form id="addProductForm" action="{{ route('admin.listUser.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="ten">Tên người dùng:</label>
                    <input type="text" id="ten" name="ten" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="role">Phân quyền:</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="user">Người dùng</option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
            </form>
            <button id="closePopupButton" class="btn btn-danger">Đóng</button>
        </div>  
    </section>
</html>
<script src="{{asset('js/admin.js')}}"></script>