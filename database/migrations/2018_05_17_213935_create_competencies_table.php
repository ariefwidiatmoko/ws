<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subjectgradeyear_id')->nullable();
            $table->text('arrayscale')->nullable();
            $table->text('arraycompetency')->nullable();
            $table->text('arrayalphabet')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('subject_id')->nullable();
            $table->integer('grade_id')->nullable();
            $table->integer('year_id')->nullable();
            $table->integer('semester_id')->nullable();
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
        Schema::dropIfExists('competencies');
    }
}
