<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yearactive extends Model
{
    protected $fillable = [
        'year_id','semester_id', 'created_by', 'updated_by', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
