<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailscoreController extends Controller
{

    public function index()
    {
      $studentscores = DB::table('studentyears')
                      ->join('students', 'studentyears.id', '=', 'students.id')
                      ->join('subjects', 'studentyears.studentyear_id' '=', 'subjects.id')
                      ->join('classroooms', 'studentyears.classroom_id', '=', 'classrooms.id')
                      ->select('students.fullname', 'studentyears.yearName', 'studentyears.semester_id', 'studentyears.gradeName', 'classrooms.name'));

      $result = $studentscores->where('statusActive', 1)->orderBy('noId')->paginate(25);

      return view('scorings.index', compact('result', '$studentscores'));
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
