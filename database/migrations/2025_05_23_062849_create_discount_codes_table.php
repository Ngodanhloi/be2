<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique(); // Mã giảm giá (VD: GIAM10)
            $table->integer('amount'); // Số tiền giảm (đơn vị VND)
            $table->dateTime('expires_at')->nullable(); // Hạn sử dụng (nếu có)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discount_codes');
    }
};
