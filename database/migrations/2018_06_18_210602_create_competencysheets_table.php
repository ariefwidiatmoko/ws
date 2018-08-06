<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetencysheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencysheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('csbatch_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->text('arraycompetencyaverage')->nullable();
            $table->text('arraycompetencygrade')->nullable();
            $table->text('competencydescription')->nullable();
            $table->unsignedInteger('classsubject_id');
            $table->foreign('classsubject_id')
                  ->references('id')->on('classsubjects')
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
        Schema::dropIfExists('competencysheets');
    }
}
