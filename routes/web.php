<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\;
use App\Http\Controllers\CateController;
use App\Http\Controllers\DonHangController;


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
Route::get('dashboard', [CrudUserController::class, 'dashboard']);

/*Admin: Crud Cate */
Route::get('admin/listcate', [CateController::class, 'index'])->name('admin.crudDanhmuc.listcate');
Route::post('/admin/listcate/store', [CateController::class, 'store'])->name('admin.listcate.store');
Route::get('/', function () {
    return view('welcome');
});

//Crud SanPham
Route::post('/admin/them/store', [SanPhamController::class, 'store'])->name('admin.them.store');
Route::get('admin/listpro', [SanPhamController::class, 'listPro'])->name('listpro');
Route::put('/admin/sua/{sanpham_id}', [SanPhamController::class, 'update'])->name('admin.crudSanPham.updatepro');
Route::delete('/admin/listpro/delete/{sanpham_id}', [SanPhamController::class, 'delete'])->name('admin.listpro.delete');


/*Admin: Crud Hoá Đơn */
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/donhang', [DonHangController::class, 'index'])->name('admin.donhang');
});
//Crud User
Route::get('admin/listUser', [CrudUserController::class,'index'])->name('admin.listUser.index');
Route::post('/admin/listUser/store', [CrudUserController::class, 'store'])->name('admin.listUser.store');
Route::delete('/admin/listUser/delete/{user_id}', [CrudUserController::class, 'delete'])->name('admin.listUser.delete');
Route::put('/admin/listUser/update/{user_id}', [CrudUserController::class, 'update'])->name('admin.listUser.update');

Route::get('/', function () {
    return view('welcome');
});
