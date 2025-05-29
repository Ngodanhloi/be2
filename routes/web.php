<?php
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::get('/profile', function () {
    return view('profile.edit');
})->middleware('auth')->name('user.profile');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});    


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
Route::post('/contact', [WelcomeController::class, 'add'])->name('contact.add');

// Trang giới thiệu
Route::get('/about', [WelcomeController::class, 'about'])->name('about');

// // Trang tin tức
Route::get('/news', [WelcomeController::class, 'news'])->name('news');

// // Trang đánh giá
Route::get('/danhgia', [WelcomeController::class, 'danhgia'])->name('danhgia');

// // Trang sản phẩm (danh sách)
Route::get('/product', [WelcomeController::class, 'product'])->name('product');

// // Trang chi tiết sản phẩm
Route::get('/product/{id}', [WelcomeController::class, 'detail'])->name('product.detail');

// // Trang lọc sản phẩm theo danh mục hoặc sắp xếpRoute::get('/listProduct/{danhmucsp_id?}/{sort?}', [WelcomeController::class, 'showListProduct'])->name('listProduct.filter');
Route::get('product/{sanpham_id}/details', [SanPhamController::class, 'details'])->name('product.details');
// // Tìm kiếm sản phẩm (thường dùng trên trang chủ)
Route::get('/search', [WelcomeController::class, 'index'])->name('search');

// // Thêm route user.dashboard ở đây, KHÔNG mở lại <?php
Route::get('/user/dashboard', [CrudUserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/listProduct/{danhmucsp_id?}/{sort?}', 'App\Http\Controllers\WelcomeController@showListProduct')->name('listProduct.filter');

Route::get('/admin', [SanPhamController::class, 'admin'])->middleware('role:admin')->name('admin.dashboard');

Route::get('/user', [SanPhamController::class, 'index'])->middleware('role:user')->name('user.index');

Route::post('/binhluan', [WelcomeController::class, 'store'])->name('binhluan.store');

// add cart
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/apply-discount', [CartController::class, 'applyDiscount'])->name('cart.applyDiscount');




Route::get('/payment', [WelcomeController::class, 'pay'])->name('payment');

Route::post('/pay', [PayController::class, 'store'])->name('pay.store');

Route::get('/pay', [PayController::class, 'showPayPage'])->name('pay');

Route::post('admin/donhang', [DonHangController::class, 'store'])->name('donhang.store');
