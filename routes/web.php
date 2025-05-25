<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;
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
Route::get('admin/listUser', [CrudUserController::class,'index'])->name('admin.listUser.index');
Route::post('/admin/listUser/store', [CrudUserController::class, 'store'])->name('admin.listUser.store');
Route::get('/', function () {
    return view('welcome');
});
