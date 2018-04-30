<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
  protected $fillable = [
      'name','alias', 'user_id'
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function classyearsems() {
      return $this->hasMany(Classyearsem::class);
  }

  public function studentyears() {
      return $this->hasMany(Studentyear::class);
  }
}
