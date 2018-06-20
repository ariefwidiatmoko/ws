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
use DB;

class ClassroomController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->get('search');
        $result = Classroom::where('classroomname', 'LIKE', '%' . $query . '%')->orderBy('classroomname')->paginate(20);
        $years = Year::all();

        return view('settings.classrooms.index', compact('result', 'query', 'years'));
    }

    public function statusActive()
    {
        $id = Input::get('id');

        $classroom = Classroom::findOrFail($id);

        $classroom->classroomactive = !$classroom->classroomactive;
        $classroom->save();

        return response()->json($classroom);
    }

    public function create()
    {
        return view('settings.classrooms.create');
    }

    public function store(Request $request)
    {

      // Validate the data
      $this->validate($request, array(
        'classroomname' => 'required|unique:classrooms',
        'alias' => 'required'
      ));

      $classroom = new Classroom;

      $classroom->user_id = Auth::user()->id;
      $classroom->classroomname = $request->classroomname;
      $classroom->alias = $request->alias;

      $classroom->save();

      $notification = array(
        'message' => ucwords($request->classroomname) . ' was successfully saved.',
        'alert-type' => 'success'
      );

      return redirect()->route('classrooms.index')->with($notification);
    }

    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classyears = Classyear::orderBy('year_id', 'desc')->get();
        $grades = Grade::all();
        $years = Year::all();
        $semesters = Semester::all();

        return view('settings.classrooms.show', compact('classroom', 'classyears', 'grades', 'years', 'semesters'));
    }

    public function edit($id)
    {
      $classroom = Classroom::findOrFail($id);

      return view('settings.classrooms.edit', compact('classroom'));
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

        $notification = array(
          'message' => 'Year was successfully updated.',
          'alert-type' => 'success'
        );

        return redirect()->route('classrooms.show', $classroom->id)->with($notification);

    }

    public function delYear($id) {
      $classyear = Classyear::findOrFail($id);

      $classyear->delete();

      $notification = array(
        'message' => 'Year was successfully deleted.',
        'alert-type' => 'error'
      );

      return back()->with($notification);
    }

    public function updateGrade(Request $request, $id) {
      $classroom = Classroom::findOrFail($id);

      $classroom->updated_by = $request->updated_by;
      $classroom->grade_id = $request->grade_id;

      $classroom->update();

      $notification = array(
        'message' => 'Grade was successfully set.',
        'alert-type' => 'success'
      );

      return redirect()->route('classrooms.show', $classroom->id)->with($notification);

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
        'classroomname' => 'required|unique:classrooms,classroomname,'.$classroom->id,
        'alias' => 'required'
      ));

      $classroom->update($request->all());

      $notification = array(
        'message' => ucwords($request->classroomname) . ' was successfully updated.',
        'alert-type' => 'success'
      );

      return redirect()->route('classrooms.index')->with($notification);
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

      $notification = array(
        'message' => ucwords($classroom->classroomname) . ' was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('classrooms.index')->with($notification);
    }

    public function yearClassroom(Request $request) {

      $crhave = Classyear::where('year_id', $request->year_id)->groupBy('classroom_id')->get();
      $year = Year::findOrFail($request->year_id);

      if(isset($crhave)) {

        $cr_id = $crhave->pluck('classroom_id')->toArray();

        $classrooms = DB::table('classrooms')->where('classroomactive', 1)->whereNotIn('id', $cr_id)->get();

        $classIds = $classrooms->pluck('id')->toArray();

        if (empty($classIds)) {

            $notification = array(
              'message' => 'Year academic '. $year->yearname .' already exist, no need to add same year academic',
              'alert-type' => 'error'
            );

            return redirect()->route('classrooms.index')->with($notification);
        }

        foreach ($classIds as $index => $item) {
          $classr = new Classyear;
          $classr->classroom_id = $classIds[$index];
          $classr->year_id = $request->year_id;
          $classr->semester_id = 1;
          $classr->save();

          $classr = new Classyear;
          $classr->classroom_id = $classIds[$index];
          $classr->year_id = $request->year_id;
          $classr->semester_id = 2;
          $classr->save();
        }

            $notification = array(
              'message' => 'Year academic '. $year->yearname .' succesfully added to some classroom',
              'alert-type' => 'success'
            );

            return redirect()->route('classrooms.index')->with($notification);

      } else {
        $classrooms = DB::table('classrooms')->where('classroomactive', 1)->get();
        $crIds = $classrooms->pluck('id')->all();

        foreach ($crIds as $index => $item) {
          $classyear = new Classyear;
          $classyear->classroom_id = $crIds[$index];
          $classyear->year_id = $request->year_id;
          $classyear->semester_id = 1;
          $classyear->save();

          $classyear = new Classyear;
          $classyear->classroom_id = $crIds[$index];
          $classyear->year_id = $request->year_id;
          $classyear->semester_id = 2;
          $classyear->save();
        }

            $notification = array(
              'message' => 'Year academic '. $year->yearname .' succesfully added to All Classroom',
              'alert-type' => 'success'
            );

            return redirect()->route('classrooms.index')->with($notification);
      }

      return back();
    }
}
