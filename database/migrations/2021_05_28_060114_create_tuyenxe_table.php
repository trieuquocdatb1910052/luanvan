<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuyenxeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuyenxe', function (Blueprint $table) {
            $table->increments('idtuyenxe');
            $table->string('diemdi',50);
            $table->string('diemden',50);
            $table->string('hinhanh',100);
            $table->float('dongia', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tuyenxe');
    }
}
