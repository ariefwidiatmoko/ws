<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = [
        'detailname', 'detaildescription', 'created_by', 'updated_by'
    ];

    public function scoringsheet()
    {
        return $this->hasMany(Scoringsheet::class);
    }
}
