<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
  protected $fillable = [
      'user_id', 'dob', 'profilename', 'phone', 'address', 'education', 'quote', 'about', 'avatar', 'updated_by',
  ];

  protected $dates = [
      'dob',
  ];

  public function user() {
      return $this->belongsTo('App\User');
  }

  public function setDobAttribute($value)
  {
      $this->attributes['dob'] = Carbon::createFromFormat('Y-m-d',$value);
  }
}
