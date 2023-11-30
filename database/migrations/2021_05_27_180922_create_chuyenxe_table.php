<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChuyenxeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuyenxe', function (Blueprint $table) {
            $table->increments('idchuyenxe');
            $table->time('giodi', 0);
            $table->time('gioden', 0);
            $table->time('ngaydi');
            $table->time('ngayden');
            $table->integer('idtuyenxe');
            $table->integer('idxe');
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
        Schema::dropIfExists('chuyenxe');
    }
}
