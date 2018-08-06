<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Studentprofile extends Model
{
  protected $fillable = [
      'student_id','user_id', 'gender', 'pob', 'dob', 'phone', 'email', 'address', 'citizenship', 'arraysibling', 'familystatus', 'childno', 'familiynote', 'healthnote', 'achievementnote', 'prevschool', 'prevschoolnote', 'afterschoolnote', 'schoolnote', 'father',
      'fatherphone', 'fatheremail', 'mother', 'motherphone', 'motheremail', 'guardian', 'guardianphone', 'guardianemail', 'parentaddress', 'parentnote', 'avatar', 'created_by', 'updated_by'
  ];

  protected $dates = ['dob'];

  protected $casts = [
      'arraysibling' => 'array',
  ];

  public function setGenderAtribute($value)
  {
    $this->attributes['gender'] = (boolean)($value);
  }

  public function getDobAtAttribute($value)
    {
        $date = Carbon::parse($value);
        return $date->format('Y-m-d');
    }

  public function student() {
      return $this->belongsTo(Student::class);
  }

  public function month()
  {
      return $this->belongsTo(Month::class);
  }

}
