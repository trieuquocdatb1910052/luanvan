<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xe', function (Blueprint $table) {
            $table->increments('idxe');
            $table->string('bienso',20);
            $table->integer('soghe');
            $table->tinyInteger('loaixe');
            $table->string('hinhxe',100);
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
        Schema::dropIfExists('xe');
    }
}
