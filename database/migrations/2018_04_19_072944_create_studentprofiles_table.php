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
            $table->string('familystatus')->nullable();
            $table->integer('siblings')->nullable();
            $table->string('childno')->nullable();
            $table->text('familiynote')->nullable();
            $table->text('healthnote')->nullable();
            $table->text('achievementnote')->nullable();
            $table->text('schoolnote')->nullable();
            $table->string('prevschool')->nullable();
            $table->text('prevschoolnote')->nullable();
            $table->text('afterschoolnote')->nullable();
            $table->string('father')->nullable();
            $table->string('fatherphone')->nullable();
            $table->string('fatheremail')->nullable();
            $table->string('mother')->nullable();
            $table->string('motherphone')->nullable();
            $table->string('motheremail')->nullable();
            $table->string('guardian')->nullable();
            $table->string('guardianphone')->nullable();
            $table->string('guardianemail')->nullable();
            $table->string('parentaddress')->nullable();
            $table->text('parentnote')->nullable();
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
