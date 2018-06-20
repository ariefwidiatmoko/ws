<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classsubject extends Model
{
  protected $fillable = [
      'csbatch_id', 'year_id', 'semester_id', 'classroom_id', 'subject_id', 'studentyear_id', 'created_by', 'updated_by'
  ];

  protected $dates = ['created_at', 'updated_at'];

  public function year()
  {
      return $this->belongsTo(Year::class);
  }

  public function semester()
  {
      return $this->belongsTo(Semester::class);
  }

  public function classroom()
  {
      return $this->belongsTo(Classroom::class);
  }

  public function studentyear()
  {
      return $this->belongsTo(Studentyear::class);
  }

  public function setscore()
  {
      return $this->hasOne(Setscore::class);
  }

  public function scoringsheet()
  {
      return $this->hasOne(Scoringsheet::class);
  }

  public function setcompetency()
  {
      return $this->hasOne(Setcompetency::class);
  }

  public function competencysheet()
  {
      return $this->hasOne(Competencysheet::class);
  }
}
