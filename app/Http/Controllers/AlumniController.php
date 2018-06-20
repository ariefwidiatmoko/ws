<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Studentyear;
use DB;

class AlumniController extends Controller
{

    public function index(Request $request)
    {
        $students = Student::query();

        if(isset($request->search)) {
          $students->where('noId', 'like', '%'.$request->search.'%')
                   ->orWhere('noIdNational', 'like', '%'.$request->search.'%')
                   ->orWhere('studentname', 'like', '%'.$request->search.'%')
                   ->orWhere('studentnick', 'like', '%'.$request->search.'%');
        }

        $result = $students->where('studentactive', 0)->orderBy('studentname')->paginate(20);

        $pagination = (isset($request->search)) ? $result->appends(['studentname' => $request->search]) : '';

        $request->flash();

        return view('academics.alumni.index', compact('students', 'result', 'request'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        $hist = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->join('semesters', 'semesters.id', '=', 'studentyears.semester_id')
                        ->join('classrooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                        ->select('studentyears.id', 'students.studentname', 'years.yearname', 'semesters.semestername', 'grades.gradename', 'classrooms.classroomname');

        $histories = $hist->where('student_id', $id)->get();

        return view('academics.alumni.show', compact('student', 'hist', 'histories'));
    }
}
