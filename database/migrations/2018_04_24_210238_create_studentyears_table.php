<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentyearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentyears', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->string('yearName')->nullable();
            $table->integer('semester_id')->nullable();
            $table->string('gradeName')->nullable();
            $table->string('classroom_id')->nullable();
            $table->string('subject_id')->nullable();
            $table->decimal('score', 5, 2)->nullable();
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
        Schema::dropIfExists('studentyears');
    }
}
