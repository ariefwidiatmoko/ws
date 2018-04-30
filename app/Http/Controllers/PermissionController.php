<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index(Request $request)
    {
      $query = $request->get('search');

      $result = Permission::where('name','like','%'.$query.'%')
                          ->orderBy('id')
                          ->paginate(20);

      return view('permissions.index', compact('result', 'query'));


      $result = Permission::paginate(100);

      return view('permissions.index', compact('result'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $this->validate($request, array(
          'name' => 'required|unique:permissions'
        ));

        Permission::create($request->all());

        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission)
    {
        //
    }

    public function edit($id)
    {
      $permission = Permission::find($id);

      return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
      $permission = Permission::findOrFail($id);

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:permissions,name,'.$permission->id
      ));

      $permission->update($request->all());

      return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        //
    }
}
