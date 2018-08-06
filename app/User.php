<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password', 'employee_id', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function employee() {
        return $this->belongsTo('App\Employee');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function classroom()
    {
        return $this->hasMany(Classroom::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function yearactive()
    {
        return $this->hasOne(Yearactive::class);
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

}
