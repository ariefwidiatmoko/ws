<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Studentyear;
use App\Semester;

class DetailscoreController extends Controller
{

    public function index()
    {
      $studentscores = DB::table('studentyears')
                      ->join('students', 'students.id', '=', 'studentyears.id')
                      ->join('semesters', 'semesters.id' '=', 'studentyears.semester_id')
                      ->join('classroooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                      ->select('students.noId', 'students.fullname', 'studentyears.yearName', 'studentyears.semester_id', 'studentyears.gradeName', 'classrooms.classroomName'));

      $result = $studentscores->where('statusActive', 1)->orderBy('noId')->paginate(25);

      return view('scorings.index', compact('result'));
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
        //
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
