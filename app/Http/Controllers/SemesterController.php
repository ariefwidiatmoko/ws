<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Semester;

class SemesterController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->get('search');
        $result = Semester::where('semestername', 'LIKE', '%' . $query . '%')->paginate(20);
        return view('semesters.index', compact('result', 'query'));
    }

    public function create()
    {
        return view('semesters.create');
    }

    public function store(Request $request)
    {

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:semesters',
        'alias' => 'required'
      ));

      $semester = new Semester;

      $semester->user_id = Auth::user()->id;
      $semester->semestername = $request->name;
      $semester->alias = $request->alias;

      $semester->save();

      flash()->success('Semester was successfully saved.');

      return redirect()->route('semesters.index');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
      $semester = Semester::findOrFail($id);

      return view('semesters.edit', compact('semester'));
    }

    public function update(Request $request, $id)
    {
      $me = $request->user();

      if( $me->hasRole('Admin') ) {
          $semester = Semester::findOrFail($id);
      } else {
          $semester = $me->semesters()->findOrFail($id);
      }

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:semesters,name,'.$semester->id,
        'alias' => 'required'
      ));

      $semester->update($request->all());

      flash()->success('Semester has been updated.');

      return redirect()->route('semesters.index');
    }

    public function destroy($id)
    {
      $me = Auth::user();

      if( $me->hasRole('Admin') ) {
          $semester = Semester::findOrFail($id);
      } else {
          $semester = $me->semesters()->findOrFail($id);
      }

      $semester->delete();

      flash()->success('Semester has been deleted.');

      return redirect()->route('semesters.index');
    }
}
