<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomEmployeeTable extends Migration
{

    public function up()
    {
        Schema::create('classroom_employee', function (Blueprint $table) {
          $table->integer('classroom_id');
          $table->integer('employee_id');
          $table->timestamps();

          $table->primary(['classroom_id', 'employee_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('classroom_employee');
    }
}
