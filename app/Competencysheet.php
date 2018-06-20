<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competencysheet extends Model
{
    protected $fillable = [
        'csbatch_id', 'type_id', 'arraycompetencygrade', 'arraycompetencyscore_avg', 'arraycompetencyscore', 'classsubject_id', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'arraycompetencygrade' => 'array',
        'arraycompetency_avg' => 'array',
        'arraycompetencyscore' => 'array',
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
