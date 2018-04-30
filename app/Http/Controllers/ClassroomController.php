<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Classroom;
use App\Classyear;
use App\Grade;
use App\Year;
use App\Semester;

class ClassroomController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->get('search');
        $result = Classroom::where('name', 'LIKE', '%' . $query . '%')->orderBy('name')->paginate(20);
        return view('classrooms.index', compact('result', 'query'));
    }

    public function statusActive()
    {
        $id = Input::get('id');

        $classroom = Classroom::findOrFail($id);

        $classroom->statusActive = !$classroom->statusActive;
        $classroom->save();

        return response()->json($classroom);
    }

    public function create()
    {
        return view('classrooms.create');
    }

    public function store(Request $request)
    {

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:classrooms',
        'alias' => 'required'
      ));

      $classroom = new Classroom;

      $classroom->user_id = Auth::user()->id;
      $classroom->name = $request->name;
      $classroom->alias = $request->alias;

      $classroom->save();

      flash()->success('Classroom was successfully saved.');

      return redirect()->route('classrooms.index');
    }

    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classyears = Classyear::all();
        $grades = Grade::all();
        $years = Year::all();
        $semesters = Semester::all();

        return view('classrooms.show', compact('classroom', 'classyears', 'grades', 'years', 'semesters'));
    }

    public function edit($id)
    {
      $classroom = Classroom::findOrFail($id);

      return view('classrooms.edit', compact('classroom'));
    }

    public function updateYear(Request $request, $id) {

        $me = $request->user();

        if( $me->hasRole('Admin') ) {
            $classroom = Classroom::findOrFail($id);
        } else {
            $classroom = $me->classrooms()->findOrFail($id);
        }

        $year = Year::findOrFail($request->years[0]);
        $sems = Semester::pluck('id')->toArray();

        $cys = new Classyear;
        $cys->classroom_id = $id;
        $cys->year_id = $year->id;
        $cys->semester_id = 1;

        $cys->save();

        $cys = new Classyear;
        $cys->classroom_id = $id;
        $cys->year_id = $year->id;
        $cys->semester_id = 2;

        $cys->save();



        flash()->success('Year has been updated.');

        return redirect()->route('classrooms.show', $classroom->id);

    }

    public function delYear($id) {
      $classyear = Classyear::findOrFail($id);

      $classyear->delete();

      flash()->success('Year has been delete.');

      return back();
    }

    public function updateGrade(Request $request, $id) {
      $classroom = Classroom::findOrFail($id);

      $classroom->updated_by = $request->updated_by;
      $classroom->grade_id = $request->grade_id;

      $classroom->update();

      flash()->success('Grade has been updated.');

      return redirect()->route('classrooms.show', $classroom->id);

    }

    public function update(Request $request, $id)
    {
      $me = $request->user();

      if( $me->hasRole('Admin') ) {
          $classroom = Classroom::findOrFail($id);
      } else {
          $classroom = $me->classrooms()->findOrFail($id);
      }

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:classrooms,name,'.$classroom->id,
        'alias' => 'required'
      ));

      $classroom->update($request->all());

      flash()->success('Classroom has been updated.');

      return redirect()->route('classrooms.index');
    }

    public function destroy($id)
    {
      $me = Auth::user();

      if( $me->hasRole('Admin') ) {
          $classroom = Classroom::findOrFail($id);
      } else {
          $classroom = $me->classrooms()->findOrFail($id);
      }

      $classroom->delete();

      flash()->success('Classroom has been deleted.');

      return redirect()->route('classrooms.index');
    }
}
