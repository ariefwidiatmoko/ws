<?php

namespace App\Http\Controllers;

use App\Authorizable;
use Illuminate\Support\Facades\Auth;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use Authorizable;

    public function index(Request $request)
    {

        $query = $request->get('search');

        $result = Role::where('name','like','%'.$query.'%')
                      ->orderBy('name')
                      ->paginate(20);

        return view('roles.index', compact('result', 'query'));
    }

    public function create()
    {
      return view('roles.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        $role = Role::create($request->only('name'));

        flash()->success('Role is added');
        return redirect()->route('roles.show', $role->id);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
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

        return view('roles.show', compact('role', 'permUsers', 'permProfiles', 'permRoles', 'permPermissions', 'permLessons', 'permSubjects', 'permFilemanager', 'permEmployees', 'permNotes', 'permMessages', 'permEvents'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permUsers = Permission::where('name','like','%'.'users'.'%')->orderBy('name')->get();
        $permProfiles = Permission::where('name','like','%'.'profiles'.'%')->orderBy('name')->get();
        $permRoles = Permission::where('name','like','%'.'roles'.'%')->orderBy('name')->get();
        $permPermissions = Permission::where('name','like','%'.'permissions'.'%')->orderBy('name')->get();
        $permLessons = Permission::where('name','like','%'.'lessons'.'%')->orderBy('name')->get();
        $permSubjects = Permission::where('name','like','%'.'subjects'.'%')->orderBy('name')->get();
        $permNotes = Permission::where('name','like','%'.'notes'.'%')->orderBy('name')->get();
        $permFilemanager = Permission::where('name','like','%'.'filemanager'.'%')->orderBy('name')->get();
        $permEmployees = Permission::where('name','like','%'.'employees'.'%')->orderBy('name')->get();
        $permMessages = Permission::where('name','like','%'.'messages'.'%')->orderBy('name')->get();
        $permEvents = Permission::where('name','like','%'.'events'.'%')->orderBy('name')->get();

        return view('roles.show', compact('role', 'permUsers', 'permProfiles', 'permRoles', 'permPermissions', 'permLessons', 'permSubjects', 'permFilemanager', 'permEmployees', 'permNotes', 'permMessages', 'permEvents'));
    }

    public function update(Request $request, $id)
    {
        if($role = Role::findOrFail($id)) {
            // admin role has everything
            if($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());
                return redirect()->route('roles.index');
            }

            // Validate the data
            $this->validate($request, array(
              'name' => 'required|unique:roles,name,'.$role->id
            ));

            $permissions = $request->get('permissions', []);

            $role->syncPermissions($permissions);

            $role->name = $request->name;
            $role->save();

            flash( $role->name . ' role & permissions has been updated.');
        } else {
            flash()->error( 'Role with id '. $id .' note found.');
        }

        return redirect()->back();
    }

    public function destroy(Role $role)
    {
      $me = Auth::user();

      if( $me->hasRole('Admin') ) {
          $role = Role::findOrFail($role->id);
      } else {
          $role = $me->categories()->findOrFail($role->id);
      }

      $role->delete();

      flash()->success('Role has been deleted.');

      return redirect()->route('roles.index');
    }

}
