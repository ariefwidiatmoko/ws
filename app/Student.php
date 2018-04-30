<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $fillable = [
      'fullname', 'noId', 'noIdNational', 'nickName', 'user_id'
  ];

  protected $dates = ['created_at'];

  public function setStatusActiveAttribute($value)
  {
    $this->attributes['statusActive'] = (boolean)($value);
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function studentyears() {
      return $this->hasMany(Studentyear::class);
  }

  public function studentprofile()
  {
      return $this->hasOne(Studentprofile::class);
  }
}
