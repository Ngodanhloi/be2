<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CateController;
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

/*Admin: Crud Cate */
Route::get('admin/listcate', [CateController::class, 'index'])->name('admin.crudDanhmuc.listcate');
Route::post('/admin/listcate/store', [CateController::class, 'store'])->name('admin.listcate.store');
Route::delete('/admin/listcate/delete/{danhmucsp_id}', [CateController::class, 'delete'])->name('admin.listcate.delete');

Route::get('/', function () {
    return view('welcome');
});
