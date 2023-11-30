<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguoidiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoidi', function (Blueprint $table) {
            $table->char('cmndnguoidi',15);
            $table->string('hotennguoidi',100);
            $table->string('gioitinhnguoidi',15);
            $table->char('sdtnguoidi',15);
            $table->char('idve',15);
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
        Schema::dropIfExists('nguoidi');
    }
}
