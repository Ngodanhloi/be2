<?php

namespace App\Exports;

use App\Models\SanPham;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SanPhamExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return SanPham::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên',
            'Mô tả',
            'Giá',
            'Sale',
            'SL trong kho',
            'SL đã bán',
            'Danh mục ID',
            'Hình ảnh'
        ];
    }

    public function map($sanpham): array
    {
        return [
            $sanpham->sanpham_id,   // sửa từ $sanpham->id
            $sanpham->ten,
            $sanpham->mota,
            $sanpham->gia,
            $sanpham->sale,
            $sanpham->soluongtrongkho,
            $sanpham->soluongdaban,
            $sanpham->danhmucsp_id,
            $sanpham->hinh,
        ];
    }
}
