<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $primaryKey = 'sanpham_id';
    protected $fillable = [ 'ten', 'mota', 'gia', 'sale', 'soluongtrongkho', 'soluongdaban','hinh'];

    public function incrementViews()
    {
        $this->views++;
        $this->save();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'danhmucsp_id', 'danhmucsp_id');
    }
}
