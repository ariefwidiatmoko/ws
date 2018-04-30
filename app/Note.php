<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
  protected $fillable = [
      'name', 'title', 'description', 'image', 'live', 'updated_by', 'user_id'
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function setLiveAttribute($value)
  {
    $this->attributes['live'] = (boolean)($value);
  }
}
