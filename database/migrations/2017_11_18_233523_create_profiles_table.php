<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{

    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
          $table->date('dob')->nullable();
          $table->string('profilename')->nullable();
          $table->string('phone')->nullable();
          $table->string('address')->nullable();
          $table->string('education')->nullable();
          $table->text('quote')->nullable();
          $table->text('about')->nullable();
          $table->string('avatar')->nullable();
          $table->string('updated_by')->nullable();
          $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
          $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
      });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
