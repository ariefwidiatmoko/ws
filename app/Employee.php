<?php

namespace App;

use Iatstuti\Database\Support\NullableFields;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    use NullableFields;

  	protected $nullable = [
  		'user_id',
  	];

    protected $fillable = [
        'fullname','dob', 'phone', 'email', 'address', 'education', 'quote', 'about', 'avatar', 'statusActive', 'created_by', 'updated_by', 'user_id',
    ];

    protected $dates = ['dob'];

    public function setStatusActiveAttribute($value)
    {
      $this->attributes['statusActive'] = (boolean)($value);
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('Y-m-d',$value);
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = $value ?: null;
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}