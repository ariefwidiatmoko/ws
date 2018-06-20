<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setcompetency extends Model
{
    protected $fillable = [
        'csbatch_id', 'type_id', 'arraycompetency_avg', 'arraycompetency', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'arraycompetency_avg' => 'array',
        'arraycompetency' => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }

    public function competencysheet()
    {
        return $this->belongsTo(Competencysheet::class);
    }
}
