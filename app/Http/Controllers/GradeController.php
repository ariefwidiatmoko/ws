<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Grade;
use App\Year;

class GradeController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->get('search');
        $result = Grade::where('gradename', 'LIKE', '%' . $query . '%')->paginate(20);
        return view('settings.grades.index', compact('result', 'query'));
    }

    public function create()
    {
        $years = Year::all();

        return view('settings.grades.create', compact('years'));
    }

    public function store(Request $request)
    {

      // Validate the data
      $this->validate($request, array(
        'gradename' => 'required|unique:grades',
        'alias' => 'required'
      ));

      $grade = new Grade;

      $grade->user_id = Auth::user()->id;
      $grade->gradename = $request->gradename;
      $grade->alias = $request->alias;

      $grade->save();

      $notification = array(
        'message' => ucwords($request->gradename) . ' was successfully saved.',
        'alert-type' => 'success'
      );

      return redirect()->route('grades.index')->with($notification);
    }

    public function show($id)
    {

        $grade = Grade::findOrFail($id);

        return view('settings.grades.show', compact('grade'));
    }

    public function edit($id)
    {
      $grade = Grade::findOrFail($id);

      return view('settings.grades.edit', compact('grade'));
    }

    public function update(Request $request, $id)
    {
      $me = $request->user();

      if( $me->hasRole('Admin') ) {
          $grade = Grade::findOrFail($id);
      } else {
          $grade = $me->grades()->findOrFail($id);
      }

      // Validate the data
      $this->validate($request, array(
        'gradename' => 'required|unique:grades,gradename,'.$grade->id,
        'alias' => 'required'
      ));

      $grade->update($request->all());

      $notification = array(
        'message' => ucwords($request->gradename) . ' was successfully updated.',
        'alert-type' => 'success'
      );


      return redirect()->route('grades.index')->with($notification);
    }

    public function destroy($id)
    {
      $me = Auth::user();

      if( $me->hasRole('Admin') ) {
          $grade = Grade::findOrFail($id);
      } else {
          $grade = $me->grades()->findOrFail($id);
      }

      $grade->delete();

      $notification = array(
        'message' => ucwords($grade->gradename) . ' was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('grades.index')->with($notification);
    }
}
