<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
  protected $fillable = ['name', 'alias', 'user_id', 'updated_by', 'live'];

  public function lessons()
  {
      return $this->hasMany(Lesson::class);
  }

  public function subjectscores() {
      return $this->hasMany(Subjectscore::class);
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function setLiveAttribute($value)
  {
    $this->attributes['live'] = (boolean)($value);
  }
}
