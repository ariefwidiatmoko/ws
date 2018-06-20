<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Typescore;

class TypescoreController extends Controller
{

    public function index()
    {
        $result = Typescore::paginate(20);

        return view('settings.typescores.index', compact('result'));
    }

    public function create()
    {
        return view('settings.typescores.create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $this->validate($request, array(
          'typename' => 'required|unique:typescores'
        ));

        $typescore = new Typescore;

        $typescore->typename = $request->typename;
        $typescore->typedescription = $request->typedescription;
        $typescore->created_by = Auth::user()->name;

        $typescore->save();

        $notification = array(
          'message' => ucwords($request->typename) . ' was successfully saved.',
          'alert-type' => 'success'
        );

        return redirect()->route('typescores.index')->with($notification);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
