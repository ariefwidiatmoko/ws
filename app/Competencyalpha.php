<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competencyalpha extends Model
{
    protected $fillable = [
        'alphabet', 'description', 'score', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'score' => 'array',
    ];
}
