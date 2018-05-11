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
use DB;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->get('search');

        if ($query == 'yes') {
            $result = Student::where('studentactive', 1)
                             ->orderBy('studentname')
                             ->paginate(20);
        }
        elseif ($query == 'no') {
            $result = Student::where('subjectactive', 0)
                             ->orderBy('studentname')
                             ->paginate(20);
        }
        else {

            $result = Student::where('studentname','like','%'.$query.'%')
                             ->orWhere('noId','like','%'.$query.'%')
                             ->orWhere('studentnick','like','%'.$query.'%')
                             ->orderBy('studentactive', 1)
                             ->orderBy('studentname')
                             ->paginate(20);

      }

      return view('students.index', compact('result', 'query'));

    }

    public function statusActive()
    {
        $id = Input::get('id');

        $student = Student::findOrFail($id);

        $student->studentactive = !$student->studentactive;
        $student->save();

        return response()->json($student);
    }

    public function create()
    {
          return view('students.create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $validatedData = $request->validate([
            'noId' => 'required|unique:students',
            'studentname' => 'required',
        ]);

        if ( $student = Student::create($request->only('user_id', 'noId', 'noIdNational', 'studentname', 'studentnick', 'studentactive')) ) {

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

        $hist = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->join('semesters', 'semesters.id', '=', 'studentyears.semester_id')
                        ->join('classrooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                        ->select('studentyears.id', 'students.studentname', 'years.yearname', 'semesters.semestername', 'grades.gradename', 'classrooms.classroomname');

        $histories = $hist->where('student_id', $id)->get();

        if(!isset($student->studentprofile)) {
            $studentprofile = new Studentprofile;
            $studentprofile->student_id = $student->id;
            $studentprofile->user_id = Auth::user()->id;

            $studentprofile->save();

            return redirect()->route('students.edit', $student->id);
        }


        return view('students.edit', compact('student', 'hist', 'histories'));
    }

    public function update(Request $request, $id)
    {
        //Validate Input
        $this->validate($request,[
          'noId' => 'required|unique:students,noId,'.$id,
          'studentname' => 'required',
        ]);

        $student = Student::findOrFail($id);
        $studentprofile = Studentprofile::where('student_id', $id)->first();

        //delete old images
        if (Input::hasFile('student_img')) {

          //delete old image
          $oldImage = public_path("images/students/{$studentprofile->avatar}"); // get previous image from folder
          if (File::exists($oldImage)) {
            File::delete($oldImage);
          }

          //save new image
          $avatar = $request->file('student_img');
          $filename = 'student_avatar_' . $current_time = Carbon::now()->toDateTimeString() . '.' . $avatar->getClientOriginalExtension();
          $location = public_path('images/students/' . $filename);
          Image::make($avatar)->fit(160)->save($location);

          $studentprofile->avatar = $filename;
        }

        if(isset($request->dob)) {
          $mm = date('m', strtotime($request->dob));
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
