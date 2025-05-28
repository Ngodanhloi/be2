<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLikesTable extends Migration
{
    public function up()
    {
        Schema::create('product_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sanpham_id');
            $table->timestamps();

            $table->unique(['user_id', 'sanpham_id']); // Mỗi user chỉ like 1 lần
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sanpham_id')->references('sanpham_id')->on('sanpham')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_likes');
    }
}