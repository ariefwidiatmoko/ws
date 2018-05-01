<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = [
      'eventname', 'allday', 'event_color', 'event_start', 'event_end', 'time_start', 'time_end', 'user_id'
  ];

  protected $dates = ['event_start', 'event_end', 'time_start', 'time_end'];

  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
