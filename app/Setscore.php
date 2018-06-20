<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setscore extends Model
{
    protected $fillable = [
        'csbatch_id', 'type_id', 'columnscore', 'arraytype', 'arraygroup_percentage', 'arraygroup', 'arraydetail_avg', 'arraydetail', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'arraytype' => 'array',
        'arraygroup_percentage' => 'array',
        'arraygroup' => 'array',
        'arraydetail_avg' => 'array',
        'arraydetail' => 'array',
    ];

    public function scoringsheet()
    {
        return $this->belongsTo(Scoringsheet::class);
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

}
