<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePositionTable extends Migration
{

    public function up()
    {
        Schema::create('employee_position', function (Blueprint $table) {
          $table->integer('employee_id');
          $table->integer('position_id');
          $table->timestamps();

          $table->primary(['employee_id', 'position_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_position');
    }
}
