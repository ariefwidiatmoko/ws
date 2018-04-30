<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{

    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('user_id')->nullable();
          $table->foreign('user_id')
                ->references('id')
                ->on('users');
          $table->unsignedInteger('month_id');
          $table->foreign('month_id')
                ->references('id')->on('months');
          $table->string('created_by')->nullable();
          $table->string('updated_by')->nullable();
          $table->boolean('statusActive')->default(0);
          $table->string('noId')->unique();
          $table->string('fullname');
          $table->date('dob')->nullable();
          $table->text('phone')->nullable();
          $table->string('email')->nullable();
          $table->string('address')->nullable();
          $table->string('education')->nullable();
          $table->text('quote')->nullable();
          $table->text('about')->nullable();
          $table->string('avatar')->nullable();
          $table->timestamps();
      });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
