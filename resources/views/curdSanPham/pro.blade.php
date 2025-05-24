<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cate Dashboard</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
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
        <section id="products-section" class="admin-section">
            <h2>Quản lý sản phẩm</h2>
            
                    @if (session('success'))
                    <div id="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <!-- Button to trigger the popup -->
                    <button id="openPopupButton" class="btn btn-primary">Thêm sản phẩm</button>
                    <!-- Popup form -->
                    <div id="popupForm" style="display: none;">
                        <form id="addProductForm" action="{{ route('roleadmin.pro.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="ten">Tên sản phẩm:</label>
                                <input type="text" id="ten" name="ten" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="mota">Mô tả:</label>
                                <input id="mota" type="hidden" name="mota">
                                
                            </div>

                            <div class="form-group">
                                <label for="gia">Giá:</label>
                                <input type="number" id="gia" name="gia" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="sale">Sale (%):</label>
                                <input type="number" id="sale" name="sale" class="form-control" value="0">
                            </div>

                            <div class="form-group">
                                <label for="hinh">Hình ảnh:</label>
                                <input type="file" id="hinh" name="hinh" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="soluongtrongkho">Số lượng trong kho:</label>
                                <input type="number" id="soluongtrongkho" name="soluongtrongkho" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="danhmucsp_id">Danh mục sản phẩm:</label>
                                <select name="danhmucsp_id" id="danhmucsp_id" class="form-control" required>
                                    @foreach ($cates as $cate)
                                        <option value="{{ $cate->danhmucsp_id }}">{{ $cate->ten }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        </form>

                        <button id="closePopupButton" class="btn btn-danger">Đóng</button>
                    </div>

                    @isset($pros)
                    @if ($pros->count())   
        </section>
    </main>
</body>
</html>
<script src="{{asset('js/admin.js')}}"></script>


