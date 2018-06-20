<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'groupname', 'groupdescription', 'created_by', 'updated_by'
    ];

    public function scoringsheets()
    {
        return $this->hasMany(Scoringsheet::class);
    }

    public function competencysheets()
    {
        return $this->hasMany(Competencysheet::class);
    }
}
