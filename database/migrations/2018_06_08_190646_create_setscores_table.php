<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setscores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('csbatch_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('columnscore')->nullable();
            $table->text('arraygroup_percentage')->nullable();
            $table->text('arraygroup')->nullable();
            $table->text('arraydetail_avg')->nullable();
            $table->text('arraydetail')->nullable();
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
        Schema::dropIfExists('setscores');
    }
}
