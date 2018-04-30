<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailscore extends Model
{

    protected $fillable = [
        'studentyear_id', 'name', 'colomn', 'percentage', 'input', 'avg'
    ];

    protected $casts = [
        'input' => 'array'
    ];

    public function studentyear()
    {
        return $this->belongsTo(Studentyear::class);
    }

}
