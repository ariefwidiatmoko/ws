<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthsTable extends Migration
{

    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->increments('id');
            $table->string('noId');
            $table->string('name');
            $table->string('alias')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('months');
    }
}
