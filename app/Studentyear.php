<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentyear extends Model
{

    protected $fillable = [
        'student_id', 'year_id', 'semester_id', 'grade_id', 'classroom_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(subject::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function subjectscores()
    {
        return $this->hasMany(Subjectscore::class);
    }
}
