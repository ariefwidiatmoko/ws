<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Grade;

class GradeController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->get('search');
        $result = Grade::where('name', 'LIKE', '%' . $query . '%')->paginate(20);
        return view('grades.index', compact('result', 'query'));
    }

    public function create()
    {
        $years = Year::all();

        return view('grades.create', compact('years'));
    }

    public function store(Request $request)
    {

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:grades',
        'alias' => 'required'
      ));

      $grade = new Grade;

      $grade->user_id = Auth::user()->id;
      $grade->name = $request->name;
      $grade->alias = $request->alias;

      $grade->save();

      flash()->success('Grade was successfully saved.');

      return redirect()->route('grades.index');
    }

    public function show($id)
    {

        $grade = Grade::findOrFail($id);

        return view('grades.show', compact('grade'));
    }

    public function edit($id)
    {
      $grade = Grade::findOrFail($id);

      return view('grades.edit', compact('grade'));
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
        'name' => 'required|unique:grades,name,'.$grade->id,
        'alias' => 'required'
      ));

      $grade->update($request->all());

      flash()->success('Grade has been updated.');

      return redirect()->route('grades.index');
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

      flash()->success('Grade has been deleted.');

      return redirect()->route('grades.index');
    }
}
