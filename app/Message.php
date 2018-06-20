<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

  protected $fillable = ['sender', 'email', 'messagetitle', 'messagecontent', 'created_by', 'updated_by', 'user_id'];



  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
