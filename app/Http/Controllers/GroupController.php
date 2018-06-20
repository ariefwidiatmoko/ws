<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
{

    public function index()
    {
        $result = Group::paginate(20);

        return view('settings.groups.index', compact('result'));
    }

    public function create()
    {
        return view('settings.groups.create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $this->validate($request, array(
          'groupname' => 'required|unique:groups'
        ));

        $group = new Group;

        $group->groupname = $request->groupname;
        $group->groupdescription = $request->groupdescription;
        $group->created_by = Auth::user()->name;

        $group->save();

        $notification = array(
          'message' => ucwords($request->groupname) . ' was successfully saved.',
          'alert-type' => 'success'
        );

        return redirect()->route('groups.index')->with($notification);
    }

    public function edit($id)
    {
        $group = Group::findOrFail($id);

        return view('settings.groups.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);

        // Validate the data
        $this->validate($request, array(
          'groupname' => 'required|unique:groups,groupname,'.$group->id
        ));

        $group->update($request->all());

        $notification = array(
          'message' => ucwords($request->groupname) . ' was successfully updated.',
          'alert-type' => 'success'
        );

        return redirect()->route('groups.index')->with($notification);
    }

    public function destroy($id)
    {
      $group = Group::findOrFail($id);

      $group->delete();

      $notification = array(
        'message' => ucwords($group->groupname) . ' was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('groups.index')->with($notification);
    }
}
