<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart');
        return view('cart', ['cart' => $cart]);
        // Tính tổng tiền từ giỏ hàng
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Lấy số tiền giảm từ session (nếu có)
        $discountAmount = session('discount_amount', 0);

        // Tính tổng tiền sau giảm
        $totalAfterDiscount = $totalPrice - $discountAmount;

        return view('cart', [
            'totalPrice' => $totalPrice,
            'totalAfterDiscount' => $totalAfterDiscount,
        ]);
    }
    public function pay(Request $request)
    {
        $amount = $request->input('totalPrice');
        // Tiến hành xử lý thanh toán với số tiền $amount
    }
    public function add(Request $request)
    {
        $productId = $request->input('sanpham_id');
        $sanPham = DB::select("select * from `sanpham` where `sanpham_id` = $productId limit 1;")[0];


        if ($sanPham) {
            $cart = session()->get('cart');

            if (isset($cart[$productId])) {
                // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
                $cart[$productId]['quantity']++;
            } else {
                // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới vào giỏ hàng
                $cart[$productId] = [
                    'id' => $sanPham->sanpham_id,
                    'name' => $sanPham->ten,
                    'price' => $sanPham->gia - $sanPham->sale,
                    'quantity' => 1,
                    'img' => $sanPham->hinh
                ];
            }

            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }
    public function update(Request $request)
    {
        // Xóa session mã giảm giá khi cập nhật giỏ hàng
        $request->session()->forget(['discount_code', 'total_after_discount']);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);

            $subtotal = $cart[$productId]['price'] * $quantity;
            $totalPrice = array_reduce($cart, function ($total, $item) {
                return $total + ($item['price'] * $item['quantity']);
            }, 0);

            return response()->json([
                'product_id' => $productId,
                'subtotal' => $subtotal,
                'totalPrice' => $totalPrice
            ]);
        }

        return response()->json(['error' => 'Không tìm thấy sản phẩm'], 404);
    }

    public function remove(Request $request)
    {
        $productId = $request->input('sanpham_id');
        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Xóa sản phẩm khỏi giỏ hàng
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }
    // public function update(Request $request)
    // {
    //     $productId = $request->input('product_id');
    //     $quantity = $request->input('quantity');

    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$productId])) {
    //         $cart[$productId]['quantity'] = $quantity;
    //         session()->put('cart', $cart);

    //         $subtotal = $cart[$productId]['price'] * $quantity;
    //         $totalPrice = array_reduce($cart, function ($total, $item) {
    //             return $total + ($item['price'] * $item['quantity']);
    //         }, 0);

    //         return response()->json([
    //             'product_id' => $productId,
    //             'subtotal' => $subtotal,
    //             'totalPrice' => $totalPrice
    //         ]);
    //     }

    //     return response()->json(['error' => 'Không tìm thấy sản phẩm'], 404);
    // }

    // public function applyDiscount(Request $request)
    // {
    //     // Lấy số tiền từ phiếu ưu đãi nhập từ form
    //     $discountAmount = $request->input('discount_amount');

    //     // Lấy tổng tiền từ biến đã tính từ trước
    //     $totalPrice = $request->session()->get('totalPrice');

    //     // Tính toán số tiền giảm
    //     $totalPriceAfterDiscount = $totalPrice - $discountAmount;

    //     // Chuyển hướng trở lại trang giỏ hàng
    //     return redirect('/cart')->with('discountApplied', true);
    // }


    // public function update(Request $request)
    // {
    //     $productId = $request->input('product_id');
    //     $quantity = $request->input('quantity');

    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$productId])) {
    //         $cart[$productId]['quantity'] = $quantity;
    //         session()->put('cart', $cart);

    //         $subtotal = $cart[$productId]['price'] * $quantity;
    //         $totalPrice = array_reduce($cart, function ($total, $item) {
    //             return $total + ($item['price'] * $item['quantity']);
    //         }, 0);

    //         return response()->json([
    //             'product_id' => $productId,
    //             'subtotal' => $subtotal,
    //             'totalPrice' => $totalPrice
    //         ]);
    //     }

    //     return response()->json(['error' => 'Không tìm thấy sản phẩm'], 404);
    // }

    public function applyDiscount(Request $request)
    {
        $code = $request->input('discount_code');

        // Kiểm tra mã giảm giá có tồn tại và còn hiệu lực không
        $discount = DiscountCode::where('code', $code)
            ->where('expires_at', '>=', now())
            ->first();

        if (!$discount) {
            return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
        }

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart');
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $discountAmount = $discount->amount;
        $totalAfterDiscount = max(0, $total - $discountAmount);

        // Lưu thông tin giảm giá vào session
        session([
            'discount_code' => $code,
            'discount_amount' => $discountAmount,
            'total_after_discount' => $totalAfterDiscount
        ]);

        return redirect()->route('cart.index')->with('success', 'Áp dụng mã giảm giá thành công!');
    }
    public function addToCart(Request $request)
    {
        $sanpham_id = $request->input('sanpham_id');
        $so_luong = $request->input('so_luong');

        // Thêm sản phẩm vào giỏ hàng với số lượng được truyền từ request
        // Code xử lý thêm sản phẩm vào giỏ hàng ở đây

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }
}
