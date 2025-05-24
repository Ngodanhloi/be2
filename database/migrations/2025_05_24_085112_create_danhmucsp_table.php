<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanhmucspTable extends Migration
{
    public function up()
    {
        Schema::create('danhmucsp', function (Blueprint $table) {
            $table->bigIncrements('danhmucsp_id');
            $table->string('ten', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('danhmucsp');
    }
}

