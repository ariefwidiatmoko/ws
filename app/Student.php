<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $fillable = [
      'studentname', 'noId', 'noIdNational', 'studentnick', 'studentactive', 'created_by', 'updated_by', 'user_id',
  ];

  protected $dates = ['created_at'];

  public function setStudentActiveAttribute($value)
  {
    $this->attributes['studentactive'] = (boolean)($value);
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
