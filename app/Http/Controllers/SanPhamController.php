<?php

namespace App\Http\Controllers;
use App\Models\SanPham;
use App\Models\Category;
use App\Models\BinhLuan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SanPhamExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listpro()
    {
        $sanphams = SanPham::paginate(5);
        // $cates = Category::all();
        return view('admin.curdSanPham.listpro', compact('sanphams'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'mota' => 'required',
            'gia' => 'required|numeric',
            'sale' => 'nullable|numeric',
            'soluongtrongkho' => 'required|numeric',
            'soluongdaban' => 'required|numeric',
            // 'danhmucsp_id' => 'required|exists:category,danhmucsp_id', // Kiểm tra ID danh mục tồn tại
            'hinh' => 'nullable|image'
            
        ]);

        $sanpham = new SanPham();
        $sanpham->ten = $request->input('ten');
        $sanpham->mota = $request->input('mota');
        $sanpham->gia = $request->input('gia');
        $sanpham->sale = $request->input('sale');
        $sanpham->soluongtrongkho = $request->input('soluongtrongkho');
        $sanpham->soluongdaban = $request->input('soluongdaban');
        // $sanpham->danhmucsp_id = $request->input('danhmucsp_id'); // Nhận ID danh mục trực tiếp từ form

        if ($request->hasFile('hinh')) {
            $file = $request->file('hinh');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Thêm thời gian để tránh trùng lặp
            $file->move(public_path('img/product'), $fileName); // Di chuyển file vào thư mục lưu trữ
            $sanpham->hinh = $fileName; // Lưu tên tệp hình ảnh vào cơ sở dữ liệu
        }

        $sanpham->save();
        return redirect('listpro')->with('success', 'Sản phẩm đã được tạo thành công.');
    }
    public function update(Request $request, $id)
    {
        $sanpham = SanPham::findOrFail($id);

        // Validate the input data
        $validatedData = $request->validate([
            'ten' => 'required',
            'mota' => 'required',
            'gia' => 'required|numeric',
            'sale' => 'nullable|numeric',
            'soluongtrongkho' => 'required|numeric',
            'soluongdaban' => 'required|numeric',
            // 'danhmucsp_id' => 'required|exists:category,danhmucsp_id',
            'hinh' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the product data
        $sanpham->ten = $validatedData['ten'];
        $sanpham->mota = $validatedData['mota'];
        $sanpham->gia = $validatedData['gia'];
        $sanpham->sale = $validatedData['sale'] ?? 0;
        $sanpham->soluongtrongkho = $validatedData['soluongtrongkho'];
        $sanpham->soluongdaban = $validatedData['soluongdaban'];
        // $sanpham->danhmucsp_id = $validatedData['danhmucsp_id'];

        // Xử lý hình ảnh
        if ($request->hasFile('hinh')) {
            $image = $request->file('hinh');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/product'), $imageName);
            $sanpham->hinh = $imageName;
        }

        $sanpham->save();

        return redirect()->route('listpro')->with('success', 'đã được thêm thành công.');
    }
    public function delete($id)
    {
        // // Delete related records in the danhgia table
        // BinhLuan::where('sanpham_id', $id)->delete();

        // Delete the SanPham record
        SanPham::destroy($id);

        return redirect('listpro')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
