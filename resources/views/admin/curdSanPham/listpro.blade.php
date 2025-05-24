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
                <!-- <li><a href="{{asset('roleadmin/pro')}}" class="nav-link">Quản lý sản phẩm</a></li>
                <li><a href="{{asset('roleadmin/cate')}}" class="nav-link">Danh Mục</a></li>
                <li><a href="{{asset('roleadmin/user')}}" class="nav-link">Quản lý tài khoản</a></li>
                <li><a href="{{ asset('roleadmin/donhang') }}">Đơn Hàng</a></li>
            </ul> -->
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
                        <form id="addProductForm" action="{{ route('admin.them.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="ten">Tên sản phẩm:</label>
                                <input type="text" id="ten" name="ten" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="mota">Mô tả:</label>
                                <input id="mota" type="hidden" name="mota">
                                <trix-editor input="mota"></trix-editor>
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
                                <label for="soluongdaban">Số lượng đã bán:</label>
                                <input type="number" id="soluongdaban" name="soluongdaban" class="form-control" required>
                            </div>


                            <!-- <select name="category_id" class="form-control">
                                <option value="">-- Chọn danh mục --</option>
                                @if (!empty($cates))
                                    @foreach ($cates as $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                @endif
                            </select> -->


                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        </form>

                        <button id="closePopupButton" class="btn btn-danger">Đóng</button>
                    </div>
                    @isset($sanphams)
                    @if ($sanphams->count())
                    <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm theo tên danh mục...">
                    <button type="button" id="searchButton">Tìm kiếm</button>
                    </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Mô Tả</th>
                                    <th>Giá</th>
                                    <th>Sale</th>
                                    <th>Hình</th>
                                    <th>Số lượng trong kho</th>
                                    <!-- <th>Danh mục</th> -->
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                    <tbody>

                        @foreach ($sanphams as $pro)
                        <tr>
                            <td>{{ $pro->sanpham_id }}</td>
                            <td>{{ $pro->ten }}</td>
                            <td>{!! $pro->mota !!}</td>
                            <td>{{ $pro->gia }}</td>
                            <td>{{ $pro->sale }}</td>
                            <td>
                                @if($pro->hinh && file_exists(public_path('img/product/'.$pro->hinh)))
                                    <img src="{{ asset('img/product/'.$pro->hinh) }}" width="80">
                                @else
                                    <img src="{{ asset('img/default.png') }}" width="80"> {{-- ảnh mặc định nếu cần --}}
                                @endif
                            </td>
                            <td>{{ $pro->soluongtrongkho }}</td>
                            <!-- <td>{{ $pro->category->ten ?? 'N/A' }}</td> -->
                            <td>{{ $pro->created_at }}</td>
                            <td> 
                            <button class="edit-button btn btn-sm btn-warning" data-product-id="{{ $pro->sanpham_id }}">Edit</button>
                            </td>
                            <div id="editFormContainer-{{ $pro->sanpham_id }}" class="edit-form-container" style="display: none;">
                        <form action="{{ route('admin.crudSanPham.updatepro', $pro->sanpham_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="ten-{{ $pro->sanpham_id }}">Tên sản phẩm:</label>
                                        <input type="text" id="ten-{{ $pro->sanpham_id }}" name="ten" value="{{ $pro->ten }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="mota-{{ $pro->sanpham_id }}">Mô tả:</label>
                                        <input id="mota-{{ $pro->sanpham_id }}" type="hidden" name="mota" value="{{ $pro->mota }}">
                                        <trix-editor input="mota-{{ $pro->sanpham_id }}"></trix-editor>
                                    </div>

                                    <div class="form-group">
                                        <label for="gia-{{ $pro->sanpham_id }}">Giá:</label>
                                        <input type="number" id="gia-{{ $pro->sanpham_id }}" name="gia" value="{{ $pro->gia }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sale-{{ $pro->sanpham_id }}">Sale (%):</label>
                                        <input type="number" id="sale-{{ $pro->sanpham_id }}" name="sale" value="{{ $pro->sale ?? 0 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="hinh-{{ $pro->sanpham_id }}">Hình ảnh:</label>
                                        <input type="file" id="hinh-{{ $pro->sanpham_id }}" name="hinh">
                                        @if($pro->hinh && file_exists(public_path('img/product/'.$pro->hinh)))
                                            <img src="{{ asset('img/product/'.$pro->hinh) }}" width="100">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="soluongtrongkho-{{ $pro->sanpham_id }}">Số lượng trong kho:</label>
                                        <input type="number" id="soluongtrongkho-{{ $pro->sanpham_id }}" name="soluongtrongkho" value="{{ $pro->soluongtrongkho }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="soluongdaban-{{ $pro->sanpham_id }}">Số lượng đã bán:</label>
                                        <input type="number" id="soluongdaban-{{ $pro->sanpham_id }}" name="soluongdaban" value="{{ $pro->soluongdaban }}" required>
                                    </div>

                                    <!-- danh muc o day -->

                                    <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
                                    <button type="button" class="btn btn-danger" onclick="closeEditForm()">Đóng</button>
                                </form>
                        </div>
                        </tr>
                @endforeach
                </tbody>
                </table>
                @else
                <p>Không có sản phẩm nào.</p>
                @endif
                </tbody>
                </table>
                @else
                <p>Không có danh mục nào.</p>
                @endif
                <div style="margin-top: 20px;">
                {{ $sanphams->links() }}
                </div>
        </section>
    </main>
</body>
</html>
<script src="{{asset('js/admin.js')}}"></script>


