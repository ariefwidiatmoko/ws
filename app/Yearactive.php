<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yearactive extends Model
{
    protected $fillable = [
        'year_id','semester_id', 'user_id', 'updated_by'
    ];

    public function year() {
        return $this->belongsTo('App\Year');
    }
}
