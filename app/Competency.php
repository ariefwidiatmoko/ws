<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    protected $fillable = [
        'competencyname', 'competencydescription', 'year_id', 'semester_id', 'grade_id', 'type_id', 'created_by', 'updated_by'
    ];

    public function competencysheets()
    {
        return $this->hasMany(Competencysheet::class);
    }
}
