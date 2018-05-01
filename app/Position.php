<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
      protected $fillable = [
          'positionname', 'positionactive', 'updated_by', 'user_id',
      ];

      public function user()
      {
          return $this->belongsTo(User::class);
      }

      public function setPositionActiveAttribute($value)
      {
        $this->attributes['positionactive'] = (boolean)($value);
      }

      public function employees()
      {
          return $this->belongsToMany(Employee::class);
      }
}
