<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassyearsTable extends Migration
{

    public function up()
    {
        Schema::create('classyears', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classroom_id');
            $table->integer('year_id');
            $table->integer('semester_id');
            $table->integer('employee_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classyears');
    }
}
