<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Classyear;
use DB;
use App\Employee;
use App\Grade;
use Illuminate\Http\Request;
use App\Semester;
use App\Student;
use App\Studentyear;
use App\Year;
use App\Yearactive;

class ClassroomstudentController extends Controller
{

    public function index(Request $request)
    {
        $yearactive = Yearactive::first();
        $students = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->join('classrooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                        ->join('semesters', 'semesters.id', '=', 'studentyears.semester_id')
                        ->select('studentyears.id', 'studentyears.year_id', 'studentyears.grade_id', 'studentyears.semester_id', 'studentyears.classroom_id', 'classrooms.classroomname', 'years.yearname', 'grades.gradename');


        //Default Index Classroom - Student showing Classroom - Student yearactive
        if(!isset($request->year_id)) {
            $students->where('year_id', 'like',  $yearactive->year_id);
        }

        if(isset($request->search)) {
            $students->where('classroomname', 'like',  "%{$request->search}%");
        }

        if(isset($request->year_id)) {
            $students->where('year_id', 'like',  $request->year_id);
        }

        if(isset($request->grade_id)) {
            $students->where('studentyears.grade_id', 'like',  $request->grade_id);
        }

        $years = Year::all();
        $grades = Grade::all();

        $request->flash();

        $result = $students->groupBy('year_id')
                           ->groupBy('classroom_id')
                           ->paginate(20);

        return view('academics.classroomstudent.index', compact('grades', 'request', 'result', 'years', 'yearactive'));
    }

    public function showDetail($id, $year_id)
    {
        $class = Classroom::findOrFail($id);
        $cryear = Classyear::where('classroom_id', $id)->where('year_id', $year_id);

        $students = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->join('classrooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                        ->join('semesters', 'semesters.id', '=', 'studentyears.semester_id')
                        ->select('students.noId', 'students.noIdNational', 'students.studentname', 'students.studentactive', 'studentyears.id', 'studentyears.student_id', 'studentyears.year_id', 'studentyears.grade_id', 'studentyears.semester_id', 'studentyears.classroom_id', 'classrooms.classroomname', 'years.yearname', 'grades.gradename')
                        ->groupBy('student_id');

        $result = $students->where('classroom_id', $id)->where('year_id', $year_id)->paginate(50);
        $classroomyear = $cryear->first();
        $employees = Employee::where('employeeactive', 1)->get();

        return view('academics.classroomstudent.show', compact('class', 'result', 'classroomyear', 'employees'));
    }

    public function updateHomeroom(Request $request, $id)
    {
        $classyears = Classyear::where('classroom_id', $request->classroom_id)->where('year_id', $request->year_id)->get();

        foreach ($classyears as $index => $item) {
          $item->employee_id = $request->employee_id;
          $item->update();
        }

        return response()->json($classyears);
    }
}
