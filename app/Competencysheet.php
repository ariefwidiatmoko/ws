<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competencysheet extends Model
{
    protected $fillable = [
        'csbatch_id', 'type_id', 'arraycompetencyaverage', 'arraycompetencygrade', 'competencydescription', 'classsubject_id', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'arraycompetencyaverage' => 'array',
        'arraycompetencygrade' => 'array',
    ];

    public function classsubject()
    {
        return $this->belongsTo(Classsubject::class);
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }
}
