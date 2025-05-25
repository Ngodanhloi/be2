<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;

class DonHangController extends Controller
{
    //
    public function index()
    {
        $donhangs = DonHang::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.curdDonHang.donhang', compact('donhangs'));
    }

   
}
