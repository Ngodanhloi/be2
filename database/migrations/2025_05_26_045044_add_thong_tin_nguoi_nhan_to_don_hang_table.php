<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('don_hang', function (Blueprint $table) {
            $table->string('ten')->nullable();
            $table->string('diachigiaohang')->nullable();
            $table->string('sdt')->nullable();
            $table->string('ghichudonhang')->nullable();
        });
    }

    public function down()
    {
        Schema::table('don_hang', function (Blueprint $table) {
            $table->dropColumn(['ten', 'diachigiaohang', 'sdt', 'ghichudonhang']);
        });
    }

};