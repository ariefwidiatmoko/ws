<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scoringsheet extends Model
{
    protected $fillable = [
        'csbatch_id', 'type_id', 'typescore', 'arraygroupscore', 'arrayscore_avg', 'arrayscore', 'classsubject_id', 'created_by', 'updated_by'
    ];

    public function classsubject()
    {
        return $this->belongsTo(Classsubject::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function detail()
    {
        return $this->belongsTo(Detail::class);
    }

    public function setscore()
    {
        return $this->hasOne(Setscore::class);
    }

    protected $casts = [
        'arraytypescore' => 'array',
        'arraygroupscore' => 'array',
        'arrayscore_avg' => 'array',
        'arrayscore' => 'array',
    ];
}
