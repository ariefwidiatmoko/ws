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
        $result = Year::where('name', 'LIKE', '%' . $query . '%')->paginate(20);
        return view('years.index', compact('result', 'query'));
    }

    public function create()
    {
        return view('years.create');
    }

    public function store(Request $request)
    {

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:years',
        'alias' => 'required'
      ));

      $year = new Year;

      $year->user_id = Auth::user()->id;
      $year->name = $request->name;
      $year->alias = $request->alias;

      $year->save();

      flash()->success('Year was successfully saved.');

      return redirect()->route('years.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $year = Year::findOrFail($id);

      return view('years.edit', compact('year'));
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
        'name' => 'required|unique:years,name,'.$year->id,
        'alias' => 'required'
      ));

      $year->update($request->all());

      flash()->success('Year has been updated.');

      return redirect()->route('years.index');
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

      flash()->success('Year has been deleted.');

      return redirect()->route('years.index');
    }
}
