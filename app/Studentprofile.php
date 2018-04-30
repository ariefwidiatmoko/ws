<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentprofile extends Model
{
  protected $fillable = [
      'student_id','user_id', 'gender', 'pob', 'dob', 'phone', 'email', 'address', 'citizenship', 'siblings', 'familyStatus', 'childNo', 'familiyNote', 'healtyNote', 'achievementNote', 'previousSchool', 'prevScNote', 'afterScNote', 'schoolNote', 'father', 'fphone', 'femail', 'mother', 'mphone', 'memail', 'guardian', 'gphone', 'gemail', 'parentNote', 'paddress', 'avatar'
  ];

  protected $dates = ['dob'];

  public function student() {
      return $this->belongsTo('App\Student');
  }

  public function month()
  {
      return $this->belongsTo(Month::class);
  }

}
