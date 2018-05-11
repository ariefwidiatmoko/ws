<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
  protected $fillable = [
      'yearname','alias', 'user_id'
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function classyears() {
      return $this->hasMany(Classyear::class);
  }

  public function studentyears() {
      return $this->hasMany(Studentyear::class);
  }

  public function yearactive()
  {
      return $this->hasOne(Yearactive::class);
  }
}
