<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\StudentCreated;
use App\Student;
use App\Studentprofile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;
use Session;
use File;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->get('search');

        if ($query == 'yes') {
            $result = Student::where('statusActive', 1)
                             ->orderBy('fullname')
                             ->paginate(20);
        }
        elseif ($query == 'no') {
            $result = Student::where('statusActive', 0)
                             ->orderBy('fullname')
                             ->paginate(20);
        }
        else {

            $result = Student::where('fullname','like','%'.$query.'%')
                             ->orWhere('noId','like','%'.$query.'%')
                             ->orWhere('nickName','like','%'.$query.'%')
                             ->orderBy('statusActive', 1)
                             ->orderBy('fullname')
                             ->paginate(20);

      }

      return view('students.index', compact('result', 'query'));

    }

    public function statusActive()
    {
        $id = Input::get('id');

        $student = Student::findOrFail($id);

        $student->statusActive = !$student->statusActive;
        $student->save();

        return response()->json($student);
    }

    public function create()
    {
          return view('students.create', compact('nowDate'));
    }

    public function store(Request $request)
    {
        // Validate the data
        $validatedData = $request->validate([
            'noId' => 'required|unique:students',
            'fullname' => 'required',
        ]);

        if ( $student = Student::create($request->only('user_id', 'noId', 'noIdNational', 'fullname', 'nickName', 'statusActive')) ) {

            event(new StudentCreated($student));

            flash('Student has been created.');

        } else {
            flash()->error('Unable to create user.');
        }

        return redirect()->route('students.edit', $student->id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);

        if(!isset($student->studentprofile)) {
            $studentprofile = new Studentprofile;
            $studentprofile->student_id = $student->id;
            $studentprofile->user_id = Auth::user()->id;

            $studentprofile->save();

            return redirect()->route('students.edit', $student->id);
        }


        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {

        $student = Student::findOrFail($id);
        $studentprofile = Studentprofile::where('student_id', $id)->first();

        // Validate the data
        $validatedData = $request->validate([
            'noId' => 'required|unique:students,noId,'.$student->id,
            'fullname' => 'required',
        ]);

        if(isset($request->dob)) {
          $mm = $request->dob->format('m');
          $studentprofile->month_id = $mm;
        }

        $student->update($request->all());

        $studentprofile->update($request->all());

        flash()->success('Student was successfully updated.');
        return back();


    }

    public function destroy($id)
    {
        //
    }
}
