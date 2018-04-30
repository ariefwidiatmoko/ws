<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classyear extends Model
{

    protected $fillable = [
        'classroom_id','year_id', 'semester_id'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
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
