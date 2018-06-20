<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\School;
use App\Year;
use App\Semester;
use App\Yearactive;
use App\Employee;
use App\User;
use DB;

class SchoolController extends Controller
{

    public function index()
    {
        $sc = School::first();

        if (!isset($sc)) {
          $school = new School;
          $school->id = 1;
          $school->created_by = Auth::user()->name;
          $school->user_id = Auth::user()->id;
          $school->save();
          $yearactive = new Yearactive;
          $yearactive->id = 1;
          $yearactive->created_by = Auth::user()->name;
          $yearactive->user_id = Auth::user()->id;
          $yearactive->save();
        }

        $school = School::findOrFail(1);
        $yearactive = Yearactive::findOrFail(1);

        return view('settings.schools.index', compact('school', 'yearactive'));
    }

    public function edit($id)
    {
        $school = School::find($id);
        $yearactive = Yearactive::find($id);

        $employees = Employee::all();
        $years = Year::all();
        $semesters = Semester::all();

        return view('settings.schools.edit', compact('school', 'yearactive', 'employees', 'years', 'semesters'));
    }

    public function editYear ($id) {
        $school = School::find($id);
        $yearactive = Yearactive::find($id);

        $years = Year::all();
        $semesters = Semester::all();

        return view('settings.schools.edityear', compact('school', 'yearactive', 'years', 'semesters'));
    }

    public function update(Request $request, $id)
    {
        $school = School::find($id);
        $yearactive = Yearactive::find($id);

        $school->update($request->all());
        $yearactive->update($request->all());

        return view('settings.schools.index', compact('school', 'yearactive'));
    }

    public function updateYear(Request $request, $id) {
        $school = School::find($id);
        $yearactive = Yearactive::find($id);

        $school->update($request->all());
        $yearactive->update($request->all());

        return redirect()->route('schools.index', compact('school', 'yearactive'));
    }
}
