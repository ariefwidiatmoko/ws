<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentyear extends Model
{

    protected $fillable = [
        'student_id', 'yeargradeclassroom_id', 'yearsemclassroom_id', 'year_id', 'semester_id', 'grade_id', 'classroom_id', 'created_by', 'updated_by', 'user_id'
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

    public function typescores()
    {
        return $this->hasMany(Typescore::class);
    }

    public function groupdetails()
    {
        return $this->hasMany(Groupdetail::class);
    }

    public function detailscores()
    {
        return $this->hasMany(Detailscore::class);
    }
}
