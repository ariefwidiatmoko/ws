<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjectscore extends Model
{

    protected $fillable = [
        'studentyear_id', 'subject_id', 'name', 'score'
    ];

    public function studentyear()
    {
        return $this->belongsTo(Studentyear::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}