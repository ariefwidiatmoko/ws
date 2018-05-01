<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
  protected $fillable = [
      'classroomname','alias', 'classroomactive', 'grade_id', 'user_id'
  ];

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

  public function grade()
  {
      return $this->belongsTo(Grade::class);
  }

  public function employees()
  {
      return $this->belongsToMany(Employee::class);
  }

  public function classyears() {
      return $this->hasMany(Classyear::class);
  }
}
