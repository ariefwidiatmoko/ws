<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
  protected $fillable = [
      'gradename','alias', 'user_id', 'created_by', 'updated_by'
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function employees()
  {
      return $this->belongsToMany(Employee::class);
  }

  public function classrooms()
  {
      return $this->hasMany(Classroom::class);
  }
}
