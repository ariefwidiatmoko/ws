<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'schoolname','principal', 'viceprincipal', 'address', 'phone', 'email', 'printdate', 'created_by', 'updated_by', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
