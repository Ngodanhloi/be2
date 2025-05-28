<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class SanPhamSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('sanpham')->insert([
                'ten' => 'Sản phẩm ' . $i,
                'mota' => 'Mô tả cho sản phẩm ' . $i,
                'gia' => rand(100000, 500000),
                'sale' => rand(0, 50),
                'hinh' => 'default.jpg',
                'soluongtrongkho' => rand(10, 100),
                'soluongdaban' => rand(0, 50),
                'danhmucsp_id' => rand(1, 5), // Đảm bảo danh mục từ 1 đến 5 đã có
                'view' => rand(0, 1000),
                'like' => rand(0, 200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
