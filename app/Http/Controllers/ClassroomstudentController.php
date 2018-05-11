<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Studentyear;
use App\Student;
use App\Classroom;
use App\Year;
use App\Semester;
use App\Grade;
use App\Classyear;

class ClassroomstudentController extends Controller
{

    public function index()
    {
        $students = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->join('classrooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                        ->join('semesters', 'semesters.id', '=', 'studentyears.semester_id')
                        ->select('studentyears.id', 'studentyears.year_id', 'studentyears.grade_id', 'studentyears.semester_id', 'studentyears.classroom_id', 'classrooms.classroomname', 'years.yearname', 'grades.gradename')
                        ->groupBy('classroom_id');

        $result = $students->paginate(20);

        return view('classroomstudent.index', compact('result'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $class = Classroom::findOrFail($id);



        $students = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->join('classrooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                        ->join('semesters', 'semesters.id', '=', 'studentyears.semester_id')
                        ->select('students.noId', 'students.noIdNational', 'students.studentname', 'students.studentactive', 'studentyears.id', 'studentyears.student_id', 'studentyears.year_id', 'studentyears.grade_id', 'studentyears.semester_id', 'studentyears.classroom_id', 'classrooms.classroomname', 'years.yearname', 'grades.gradename')
                        ->groupBy('student_id');

        $result = $students->where('classroom_id', $id)->paginate(50);
        $yr = $students->where('classroom_id', $id)->first();

        return view('classroomstudent.show', compact('class', 'result', 'yr'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
