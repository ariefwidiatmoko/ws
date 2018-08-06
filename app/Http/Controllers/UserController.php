<?php

namespace App\Http\Controllers;

use App\User;
use App\Events\UserCreated;
use App\Profile;
use App\Employee;
use App\Role;
use App\Permission;
use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    use Authorizable;

    public function index(Request $request)
    {
        $query = $request->get('search');
        $result = User::where('name', 'LIKE', '%' . $query . '%')->paginate(20);
        return view('usermanagements.users.index', compact('result', 'query'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('usermanagements.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // has password
        $request->merge(['password' => $request->get('password')]);

        $check_email = User::where('email', $request->email)->first();

        if($check_email) {

          flash()->error('Email already used.');
          return back();
        }

        // Create the user
        if ( $user = User::create($request->except('roles', 'permissions')) ) {

            event(new UserCreated($user));

            $this->syncPermissions($request, $user);

            flash('User has been created.');

        } else {
            flash()->error('Unable to create user.');
        }

        return redirect()->route('users.index');
    }

    public function showLink($id)
    {
        $user = User::find($id);
        $employees = Employee::all();

        return view('usermanagements.users.link', compact('user', 'employees'));
    }

    public function updateLink(Request $request, $id)
    {

        $user = User::findOrFail($id);

        if(empty($request->employee_id)) {
            $user->employee_id = null;
            $user->update();

            $notification = array(
              'message' => 'Link to employee successfully saved',
              'alert-type' => 'success'
            );

            return redirect()->route('users.index')->with($notification);
        } else {
            $user->employee_id = $request->employee_id;
            $user->update();

            $notification = array(
              'message' => 'Link to employee successfully updated',
              'alert-type' => 'success'
            );

            return redirect()->route('users.index')->with($notification);
        }
    }

    public function changePassword($id) {
        $user = User::findOrFail($id);

        return view('usermanagements.users.changepwd', compact('user'));
    }

    public function deleteLink($id) {
        $user = User::findOrFail($id);
        $employee = Employee::where('user_id', $id)->first();

        $employee->user_id = '';

        $employee->update();

        flash('Link to employee has been delete.');
        return redirect()->route('users.index');
    }

    public function updatePassword(Request $request, $id) {
        $user = User::findOrFail($id);

        if(isset($request)) {
          $user->password = $request->password;

          $user->update();

          flash()->success('Password has been updated.');

          return redirect()->route('home');
        }

        return view('usermanagements.users.changepwd', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        $permUsers = Permission::where('name','like','%'.'users'.'%')->get();
        $permProfiles = Permission::where('name','like','%'.'profiles'.'%')->get();
        $permRoles = Permission::where('name','like','%'.'roles'.'%')->get();
        $permPermissions = Permission::where('name','like','%'.'permissions'.'%')->get();
        $permLessons = Permission::where('name','like','%'.'lessons'.'%')->get();
        $permSubjects = Permission::where('name','like','%'.'subjects'.'%')->get();
        $permNotes = Permission::where('name','like','%'.'notes'.'%')->get();
        $permFilemanager = Permission::where('name','like','%'.'filemanager'.'%')->get();
        $permEmployees = Permission::where('name','like','%'.'employees'.'%')->get();
        $permMessages = Permission::where('name','like','%'.'messages'.'%')->get();
        $permEvents = Permission::where('name','like','%'.'events'.'%')->get();

        return view('usermanagements.users.edit', compact('user', 'roles', 'permUsers', 'permProfiles', 'permRoles', 'permPermissions', 'permLessons', 'permSubjects', 'permFilemanager', 'permEmployees', 'permNotes', 'permMessages', 'permEvents'));
    }

    public function update(Request $request, $id)
    {

        // Get the user
        $user = User::findOrFail($id);

        // Update user
        $user->fill($request->except('roles', 'permissions', 'password'));

        // Handle the user roles
        $this->syncPermissions($request, $user);

        $user->save();

        flash()->success('User has been updated.');

        return redirect()->route('users.edit', $user->id);
    }

    public function destroy($id)
    {
        if ( Auth::user()->id == $id ) {
            flash()->warning('Deletion of currently logged in user is not allowed :(')->important();
            return redirect()->back();
        }

        if( User::findOrFail($id)->delete() ) {
            flash()->success('User has been deleted');
        } else {
            flash()->success('User not deleted');
        }

        return redirect()->back();
    }

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        return $user;
    }
}
