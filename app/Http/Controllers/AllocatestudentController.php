<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Student;
use App\Year;
use App\Semester;
use App\Grade;
use App\Classroom;
use App\Studentyear;
use DB;

class AllocatestudentController extends Controller
{
    public function index(Request $request) {

        $students = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->select('students.noId', 'students.studentname', 'students.studentactive', 'studentyears.id', 'studentyears.student_id', 'studentyears.year_id', 'studentyears.grade_id', 'studentyears.semester_id', 'years.yearname', 'grades.gradename', 'studentyears.classroom_id');

        $crs = DB::table('classyears')
                      ->join('classrooms', 'classrooms.id', '=','classyears.classroom_id')
                      ->join('years', 'years.id', '=', 'classyears.year_id')
                      ->join('grades', 'grades.id', '=', 'classrooms.grade_id');

        if (isset($request->search)) {
            $students->where('studentname', 'like',  "%{$request->search}%");
        }

        if (isset($request->year_id)) {
            $students->where('year_id', 'like',  "%{$request->year_id}%");
            $crs->where('year_id', $request->year_id);
        }

        if (isset($request->grade_id)) {
            $students->where('grade_id', 'like',  "%{$request->grade_id}%");
            $crs->where('grade_id', $request->grade_id);
        }

        $students->where('semester_id', 1);
        $crs->where('semester_id', 1);

        $years = Year::all();
        $grades = Grade::all();

        $request->flash();

        $results = $students->where('studentactive', 1)->whereNull('classroom_id')->orderBy('noId')->paginate(50);
        $classrooms = $crs->where('classroomactive', 1)->orderBy('classroomname')->get();

        return view('settings.allocatestudents.index', compact('results', 'students', 'request', 'crs', 'classrooms', 'years', 'grades'));
    }

    public function update() {

        $id = Input::get('id');
        $sd = Input::get('student_id');
        $yr = Input::get('year_id');
        $gr = Input::get('grade_id');
        $cr = Input::get('classroom_id');

        $students = Studentyear::where('student_id', $sd)->where('year_id', $yr)->where('grade_id', $gr)->where('semester_id', '>=', 0)->get();

        foreach ($students as $index => $student) {
          $student->update([
            'classroom_id' => $cr,
            'sybatch_id' => $yr . $gr . $cr,
          ]);
        }

        return response()->json($students);
    }

    public function updateAllocate(Request $request, $id) {
      $student = Studentyear::findOrFail($id);
      $class = Classroom::where('classroomname', $request->classroomname)->first();

      $student->classroom_id = $class->id;
      $student->update();

      return response()->json($student);

    }
}
