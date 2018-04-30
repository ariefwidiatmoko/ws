<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
      protected $fillable = [
          'name', 'live', 'updated_by', 'user_id',
      ];

      public function user()
      {
          return $this->belongsTo(User::class);
      }

      public function setLiveAttribute($value)
      {
        $this->attributes['live'] = (boolean)($value);
      }

      public function employees()
      {
          return $this->belongsToMany(Employee::class);
      }
}
