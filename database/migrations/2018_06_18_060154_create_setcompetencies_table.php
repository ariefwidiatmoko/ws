<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetcompetenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setcompetencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('csbatch_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->text('arraygroupcompetency')->nullable();
            $table->text('arraycompetency_avg')->nullable();
            $table->text('arraycompetency')->nullable();
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
        Schema::dropIfExists('setcompetencies');
    }
}
