<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'typename', 'typedescription', 'created_by', 'updated_by'
    ];

    public function setscores()
    {
        return $this->hasMany(Setscore::class);
    }

    public function scoringsheets()
    {
        return $this->hasMany(Scoringsheet::class);
    }

    public function setcompetencies()
    {
        return $this->hasMany(setcompetency::class);
    }

    public function competencysheets()
    {
        return $this->hasMany(Competencysheet::class);
    }
}
