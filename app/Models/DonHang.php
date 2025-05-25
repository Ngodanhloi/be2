<?php

namespace App\Models;
use App\Models\User;
use App\Models\SanPham;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    // Tên bảng tương ứng trong CSDL
    protected $table = 'don_hang';

    // // Khóa chính khác 'id', vì bạn dùng 'donhang_id'
    // protected $primaryKey = 'donhang_id';

    // Nếu khóa chính không phải số tự tăng (auto increment), thì cần:
    public $incrementing = true;

    // Kiểu dữ liệu của khóa chính (nếu không phải số thì sửa lại)
    protected $keyType = 'int';

    // Trường được phép gán hàng loạt
    protected $fillable = [
        'user_id',
        'sanpham_id',
        'ngaydat',
        'tongtien',
    ];
    // public function user() {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
    
    // public function sanpham() {
    //     return $this->belongsTo(SanPham::class, 'sanpham_id');
    // }
    
}
