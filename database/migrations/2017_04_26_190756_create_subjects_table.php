<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('studentyear_id');
            $table->foreign('studentyear_id')
                  ->references('id')->on('studentyears')
                  ->onDelete('cascade');
            $table->integer('no_subject')->nullable();
            $table->string('name');
            $table->string('alias');
            $table->string('score');
            $table->string('updated_by')->nullable();
            $table->boolean('live')->default(0);
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
