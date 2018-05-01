<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Events\UserCreated;
use Session;

class MyprofileController extends Controller
{

    public function myprofile($profilename)
    {
        $user = User::whereName($profilename)->first();

        return view('profiles.myprofile', compact('user'));
    }
}
