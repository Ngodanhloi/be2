<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CrudSanPhamController;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\CateController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Dashboard
Route::get('/dashboard', [CrudUserController::class, 'dashboard']);

// Admin: Crud Cate
Route::get('admin/listcate', [CateController::class, 'index'])->name('admin.crudDanhmuc.listcate');
Route::post('/admin/listcate/store', [CateController::class, 'store'])->name('admin.listcate.store');

// Crud SanPham
Route::post('/admin/them/store', [SanPhamController::class, 'store'])->name('admin.them.store');
Route::get('admin/listpro', [SanPhamController::class, 'listPro'])->name('listpro');
Route::put('/admin/sua/{sanpham_id}', [SanPhamController::class, 'update'])->name('admin.crudSanPham.updatepro');
Route::delete('/admin/listpro/delete/{sanpham_id}', [SanPhamController::class, 'delete'])->name('admin.listpro.delete');

// Admin: Crud Hoá Đơn (cần đăng nhập)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/donhang', [DonHangController::class, 'index'])->name('admin.donhang');
    Route::delete('/donhang/{donhang_id}', [DonHangController::class, 'destroy'])->name('admin.donhang.delete');
});

// Xem chi tiết đơn hàng (không cần đăng nhập)
Route::get('/donhang/{donhang_id}', [DonHangController::class, 'show'])->name('admin.donhang.show');

// Crud User
Route::prefix('admin')->group(function () {
    Route::get('/listUser', [CrudUserController::class,'index'])->name('admin.listUser.index');
    Route::post('/listUser/store', [CrudUserController::class, 'store'])->name('admin.listUser.store');
    Route::delete('/listUser/delete/{user_id}', [CrudUserController::class, 'delete'])->name('admin.listUser.delete');
    Route::put('/listUser/update/{user_id}', [CrudUserController::class, 'update'])->name('admin.listUser.update');
});

// Auth routes
require __DIR__.'/auth.php';

// Trang chủ (cần đăng nhập)
Route::get('/', [WelcomeController::class, 'index'])->middleware('auth')->name('index');

// // Trang liên hệ
Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');

// Trang giới thiệu
Route::get('/about', [WelcomeController::class, 'about'])->name('about');

// // Trang tin tức
// Route::get('/news', [WelcomeController::class, 'news'])->name('news');

// // Trang đánh giá
Route::get('/danhgia', [WelcomeController::class, 'danhgia'])->name('danhgia');

// // Trang sản phẩm (danh sách)
Route::get('/product', [WelcomeController::class, 'product'])->name('product');

// // Trang chi tiết sản phẩm
Route::get('/product/{id}', [WelcomeController::class, 'detail'])->name('product.detail');

// // Trang lọc sản phẩm theo danh mục hoặc sắp xếpRoute::get('/listProduct/{danhmucsp_id?}/{sort?}', [WelcomeController::class, 'showListProduct'])->name('listProduct.filter');

// // Tìm kiếm sản phẩm (thường dùng trên trang chủ)
Route::get('/search', [WelcomeController::class, 'index'])->name('search');

// // Thêm route user.dashboard ở đây, KHÔNG mở lại <?php
Route::get('/user/dashboard', [CrudUserController::class, 'dashboard'])->name('user.dashboard');