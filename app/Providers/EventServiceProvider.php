<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        'App\Events\UserCreated' => [
            'App\Listeners\CreateProfile',
        ],
        'App\Events\StudentCreated' => [
            'App\Listeners\CreateStudentprofile',
        ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
