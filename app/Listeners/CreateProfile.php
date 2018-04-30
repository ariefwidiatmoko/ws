<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Profile;
use App\User;

class CreateProfile
{


    public function __construct()
    {
        //
    }


    public function handle(UserCreated $event)
    {
      $profile = new Profile();

      $event->user->profile()->save($profile);
    }
}
