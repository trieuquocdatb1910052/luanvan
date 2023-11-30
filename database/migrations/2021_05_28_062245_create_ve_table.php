<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ve', function (Blueprint $table) {
            $table->increments('idve');
            $table->char('cmnd',15);
            $table->string('hoten',100);
            $table->string('gioitinh',15);
            $table->char('sdt',15);
            $table->integer('soluong');
            $table->float('tongtien');
            $table->tinyInteger('trangthai');
            $table->integer('idchuyenxe');
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
        Schema::dropIfExists('ve');
        
    }
}
