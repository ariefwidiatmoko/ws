<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentprofiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');
            $table->unsignedInteger('month_id')->nullable();
            $table->foreign('month_id')
                  ->references('id')->on('months')
                  ->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('pob')->nullable();
            $table->date('dob')->nullable();
            $table->boolean('gender')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('familyStatus')->nullable();
            $table->integer('siblings')->nullable();
            $table->string('childNo')->nullable();
            $table->text('familiyNote')->nullable();
            $table->text('healthNote')->nullable();
            $table->text('achievementNote')->nullable();
            $table->text('schoolNote')->nullable();
            $table->string('previousSchool')->nullable();
            $table->text('prevScNote')->nullable();
            $table->text('afterScNote')->nullable();
            $table->string('father')->nullable();
            $table->string('fphone')->nullable();
            $table->string('femail')->nullable();
            $table->string('mother')->nullable();
            $table->string('mphone')->nullable();
            $table->string('memail')->nullable();
            $table->string('guardian')->nullable();
            $table->string('gphone')->nullable();
            $table->string('gemail')->nullable();
            $table->string('paddress')->nullable();
            $table->text('parentNote')->nullable();
            $table->string('avatar')->nullable();
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
        Schema::dropIfExists('studentprofiles');
    }
}
