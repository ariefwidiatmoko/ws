<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Year;
use Illuminate\Support\Facades\Auth;

class YearController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->get('search');
        $result = Year::where('yearname', 'LIKE', '%' . $query . '%')->paginate(20);
        return view('settings.years.index', compact('result', 'query'));
    }

    public function create()
    {
        return view('settings.years.create');
    }

    public function store(Request $request)
    {

      // Validate the data
      $this->validate($request, array(
        'yearname' => 'required|unique:years',
        'alias' => 'required'
      ));

      $year = new Year;

      $year->user_id = Auth::user()->id;
      $year->yearname = $request->yearname;
      $year->alias = $request->alias;

      $year->save();

      $notification = array(
        'message' => ucwords($request->yearname) . ' was successfully saved.',
        'alert-type' => 'success'
      );

      return redirect()->route('years.index')->with($notification);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $year = Year::findOrFail($id);

      return view('settings.years.edit', compact('year'));
    }

    public function update(Request $request, $id)
    {
      $me = $request->user();

      if( $me->hasRole('Admin') ) {
          $year = Year::findOrFail($id);
      } else {
          $year = $me->years()->findOrFail($id);
      }

      // Validate the data
      $this->validate($request, array(
        'yearname' => 'required|unique:years,yearname,'.$year->id,
        'alias' => 'required'
      ));

      $year->update($request->all());

      $notification = array(
        'message' => ucwords($request->yearname) . ' was successfully updated.',
        'alert-type' => 'success'
      );

      return redirect()->route('years.index')->with($notification);
    }

    public function destroy($id)
    {
      $me = Auth::user();

      if( $me->hasRole('Admin') ) {
          $year = Year::findOrFail($id);
      } else {
          $year = $me->years()->findOrFail($id);
      }

      $year->delete();

      $notification = array(
        'message' => ucwords($year->yearname) . ' was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('years.index')->with($notification);
    }
}
