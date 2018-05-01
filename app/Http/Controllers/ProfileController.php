<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\Employee;
use Carbon\Carbon;
use Image;
use Session;
use File;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
      $query = $request->get('search');

      $result = Profile::where('profilename','like','%'.$query.'%')
                    ->orWhere('address','like','%'.$query.'%')
                    ->orWhere('education','like','%'.$query.'%')
                    ->orWhereHas('user', function ($q) use ($query) {
                       $q->where('name', 'like', '%'.$query.'%')
                         ->orWhere('email','like','%'.$query.'%');
                       })
                    ->orderBy('id')
                    ->paginate(20);

      return view('profiles.index', compact('result', 'query'));
    }

    public function show($id)
    {
      $profile = Profile::findOrFail($id);

      return view('profiles.show', compact('profile'));
    }

    public function edit($id)
    {
      $profile = Profile::findOrFail($id);

      return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
      $profile = Profile::findOrFail($id);
      $user = User::findOrFail($id);
      $input = $request->all();
      $employee = Employee::where('user_id', $id)->first();

      //save Image Avatar
      if (Input::hasFile('profile_avatar')) {

          //delete old image
          $oldImage = public_path("images/avatar/{$user->avatar}"); // get previous image from folder
          if (File::exists($oldImage)) {
          File::delete($oldImage);
          }
          //save new image
          $avatar = $request->file('profile_avatar');
          $filename = 'avatar_' . $current_time = Carbon::now()->toDateTimeString() . '.' . $avatar->getClientOriginalExtension();
          $location = public_path('images/avatar/' . $filename);
          Image::make($avatar)->resize(400, 400)->save($location);

          $profile->avatar = $filename;
      }

      if ($request->filled('password')) {

        $profile->update($request->all());
        $profile->user()->update($input);

      } else {

        $input1 = $request->except('password');

        $profile->update($request->all());
        $profile->user()->update($input1);

      }
      //Update Employee from Profile Update
      if(isset($employee)) {
        $employee->update($request->only('phone', 'address'));
      }

      flash()->success('The profile was successfully updated.');
      return back();
    }

    public function myprofile($profilename)
    {
        $user = User::whereProfilename($profilename)->first();

        return view('profiles.myprofile', compact('user'));
    }
}
