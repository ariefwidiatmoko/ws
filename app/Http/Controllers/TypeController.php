<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
{

    public function index()
    {
        $result = Type::paginate(20);

        return view('settings.types.index', compact('result'));
    }

    public function create()
    {
        return view('settings.types.create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $this->validate($request, array(
          'typename' => 'required|unique:types'
        ));

        $type = new Type;

        $type->typename = $request->typename;
        $type->typedescription = $request->typedescription;
        $type->created_by = Auth::user()->name;

        $type->save();

        $notification = array(
          'message' => ucwords($request->typename) . ' was successfully saved.',
          'alert-type' => 'success'
        );

        return redirect()->route('types.index')->with($notification);
    }

    public function edit($id)
    {
        $type = Type::findOrFail($id);

        return view('settings.types.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);

        // Validate the data
        $this->validate($request, array(
          'typename' => 'required|unique:types,typename,'.$type->id
        ));

        $type->update($request->all());

        $notification = array(
          'message' => ucwords($request->typename) . ' was successfully updated.',
          'alert-type' => 'success'
        );

        return redirect()->route('types.index')->with($notification);
    }

    public function destroy($id)
    {
      $type = Type::findOrFail($id);

      $type->delete();

      $notification = array(
        'message' => ucwords($type->typename) . ' was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('types.index')->with($notification);
    }
}
