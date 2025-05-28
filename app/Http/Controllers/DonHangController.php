<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Facades\Auth; // Thêm dòng này

class DonHangController extends Controller
{
    public function index()
    {
        $donhangs = DonHang::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.crudDonHang.donhang', compact('donhangs'));
    }
    public function destroy($id)
    {
        $donhang = DonHang::findOrFail($id);
        $donhang->delete();
        return redirect()->back()->with('success', 'Đã xóa đơn hàng.');
    }
}