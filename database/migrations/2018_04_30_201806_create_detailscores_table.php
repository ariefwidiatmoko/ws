<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailscores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedInteger('subjectscore_id')->nullable();
            $table->foreign('subjectscore_id')
                  ->references('id')->on('subjectscores')
                  ->onDelete('cascade');
            $table->string('detailscorename');
            $table->integer('colomn')->nullable();
            $table->integer('percentage')->nullable();
            $table->string('input')->nullable();
            $table->integer('avg')->nullable();
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
        Schema::dropIfExists('detailscores');
    }
}
