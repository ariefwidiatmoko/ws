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
        'semestername' => 'required|unique:semesters',
        'alias' => 'required'
      ));

      $semester = new Semester;

      $semester->user_id = Auth::user()->id;
      $semester->semestername = $request->semestername;
      $semester->alias = $request->alias;

      $semester->save();

      $notification = array(
        'message' => ucwords($request->semestername) . ' was successfully saved.',
        'alert-type' => 'success'
      );

      return redirect()->route('semesters.index')->with($notification);
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
        'semestername' => 'required|unique:semesters,semestername,'.$semester->id,
        'alias' => 'required'
      ));

      $semester->update($request->all());

      $notification = array(
        'message' => ucwords($request->semestername) . ' was successfully updated.',
        'alert-type' => 'success'
      );

      return redirect()->route('semesters.index')->with($notification);
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

      $notification = array(
        'message' => ucwords($semester->semestername) . ' was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('semesters.index')->with($notification);
    }
}
