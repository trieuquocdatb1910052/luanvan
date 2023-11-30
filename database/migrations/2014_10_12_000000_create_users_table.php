<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('idtk');
            $table->string('tentaikhoan',30);
            $table->string('password',200);
            $table->string('email',30);
            $table->string('hoten',30);
            $table->string('gioitinh',15);
            $table->char('cmnd',15);
            $table->char('sdt',15);
            $table->string('diachi',30);
            $table->tinyInteger('level');
            $table->string('code');
            $table->string('lydo',200);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
