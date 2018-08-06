<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    protected $fillable = [
        'subjectgradeyear_id', 'subject_id', 'arrayscale', 'arraycompetency', 'arrayalphabet', 'type_id', 'grade_id', 'year_id', 'semester_id', 'created_by', 'updated_by'
    ];

    protected $table = 'competencies';

    protected $casts = [
        'arrayscale' => 'array',
        'arraycompetency' => 'array',
        'arrayalphabet' => 'array',
    ];

    public function competencysheets()
    {
        return $this->hasMany(Competencysheet::class);
    }
}
