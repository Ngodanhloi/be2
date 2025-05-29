<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ThongTinThanhToan;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;

class PayController extends Controller
{
    public function processPayment(Request $request)
    {
        $cartSession = session()->get('cart');
        $currentUser = auth()->user();

        $cart = DonHang::create([
            'user_id' => $currentUser->user_id,
        ]);

        ThongTinThanhToan::create([
            'id' => $cart->id,
            'ten' => $request->input('ten'),
            'diachigiaohang' => $request->input('diachigiaohang'),
            'sdt' => $request->input('sdt'),
            'ghichudonhang' => $request->input('ghichudonhang'),
            'user_id' => $currentUser->user_id,
        ]);

        foreach ($cartSession as $item) {
            ChiTietDonHang::create([
                'donhang_id' => $cart->id,
                'sanpham_id' => $item['id'],
                'soluong' => $item['quantity'],
                'gia_sp' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return view('buy-success');
    }

    public function showPayPage()
    {
        $cartItems = session()->get('cart', []);
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('pay', compact('cartItems', 'totalPrice'));
    }

    public function store(Request $request)
    {
        return response()->json(['status' => 'success']);
    }
}


