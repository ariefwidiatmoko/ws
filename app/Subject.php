<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
  protected $fillable = ['no_subject', 'subjectname', 'alias', 'user_id', 'created_by', 'updated_by', 'subjectactive'];

  public function setSubjectActiveAttribute($value)
  {
    $this->attributes['subjectactive'] = (boolean)($value);
  }

  public function lessons()
  {
      return $this->hasMany(Lesson::class);
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function classsubjects() {
      return $this->hasMany(Classsubject::class);
  }
}
