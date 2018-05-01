<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
  protected $fillable = [
      'notesegment', 'notetitle', 'description', 'image', 'noteactive', 'updated_by', 'user_id'
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function setNoteActiveAttribute($value)
  {
    $this->attributes['noteactive'] = (boolean)($value);
  }
}
