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
        return view('roleadmin.donhang', compact('donhangs'));
    }

    public function destroy($id)
    {
        $donhang = DonHang::findOrFail($id);
        $donhang->delete();
        return redirect()->back()->with('success', 'Đã xóa đơn hàng.');
    }

    public function show($id)
    {
        $donhang = DonHang::with(['user', 'sanpham'])->findOrFail($id);
        return view('roleadmin.donhang_show', compact('donhang'));
    }


    public function store(Request $request)
    {

        \Log::info('Đã vào store DonHang', $request->all());
        $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required',
            'cart.*.price' => 'required|numeric',
            'cart.*.quantity' => 'required|numeric',
            'tongtien' => 'required|numeric',
            'ten' => 'required|string',
            'diachigiaohang' => 'required|string',
            'sdt' => 'required|string',
            'ghichudonhang' => 'nullable|string',
        ]);

        foreach ($request->cart as $item) {
            \Log::info('Số lượng chuẩn bị lưu:', ['soluong' => $item['quantity']]);
            DonHang::create([
                'user_id' => Auth::id(),
                'sanpham_id' => $item['id'],
                'soluong' => $item['quantity'],
                'ngaydat' => now(),
                'tongtien' => $item['price'] * $item['quantity'],
                'trangthai' => 'thanh_cong',
                'ten' => $request->ten,
                'diachigiaohang' => $request->diachigiaohang,
                'sdt' => $request->sdt,
                'ghichudonhang' => $request->ghichudonhang,
            ]);
        }

        \Log::info('Cart data:', $request->cart);
        return response()->json(['success' => true, 'message' => 'Bạn đã đặt hàng thành công!']);
    }
}