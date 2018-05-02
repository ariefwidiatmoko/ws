<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjectscores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedInteger('studentyear_id')->nullable();
            $table->foreign('studentyear_id')
                  ->references('id')->on('studentyears')
                  ->onDelete('cascade');
            $table->unsignedInteger('subject_id')->nullable();
            $table->foreign('subject_id')
                  ->references('id')->on('subjects')
                  ->onDelete('cascade');
            $table->string('subjectscorename')->nullable();
            $table->decimal('subjectscorefinal', 5, 2)->nullable();
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
        Schema::dropIfExists('subjectscores');
    }
}
