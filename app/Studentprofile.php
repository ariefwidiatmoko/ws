<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentprofile extends Model
{
  protected $fillable = [
      'student_id','user_id', 'gender', 'pob', 'dob', 'phone', 'email', 'address', 'citizenship', 'siblings', 'familystatus', 'childno', 'familiynote', 'healthnote', 'achievementnote', 'prevschool', 'prevschoolnote', 'afterschoolnote', 'schoolnote', 'father',
      'fatherphone', 'fatheremail', 'mother', 'motherphone', 'motheremail', 'guardian', 'guardianphone', 'guardianemail', 'parentaddress', 'parentnote', 'avatar', 'created_by', 'updated_by'
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
