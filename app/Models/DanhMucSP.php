<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMucSP extends Model
{
    protected $table = 'danhmucsp';
    protected $primaryKey = 'danhmucsp_id';
    protected $fillable = ['ten'];
}
