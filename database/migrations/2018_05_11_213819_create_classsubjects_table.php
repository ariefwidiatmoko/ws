<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasssubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classsubjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('csbatch_id')->nullable();
            $table->integer('year_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->integer('classroom_id')->nullable();
            $table->unsignedInteger('subject_id');
            $table->foreign('subject_id')
                  ->references('id')->on('subjects')
                  ->onDelete('cascade');
            $table->unsignedInteger('studentyear_id');
            $table->foreign('studentyear_id')
                  ->references('id')->on('studentyears')
                  ->onDelete('cascade');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('classsubjects');
    }
}
