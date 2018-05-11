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
class SetstudentController extends Controller
{

    public function index(Request $request)
    {
        $input = $request->all();
        $students = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->select('students.id', 'students.noId', 'students.studentname', 'studentyears.year_id', 'studentyears.grade_id', 'studentyears.semester_id', 'years.yearname', 'grades.gradename');

        if (isset($request->search)) {
            $students->where('studentname', 'like',  "%{$request->search}%");
        }

        if (isset($request->year_id)) {
            $students->where('year_id', 'like',  "%{$request->year_id}%");
        }

        if (isset($request->grade_id)) {
        $students->where('grade_id', 'like',  "%{$request->grade_id}%");
        }

        $result = $students->where('studentactive', 1)->where('semester_id', 1)->orderBy('noId')->orderBy('gradename')->paginate(25);

        $pagination = (isset($request->search)) ? $result->appends(['studentname' => $request->search]) : '';
        $pagination = (isset($request->year_id)) ? $result->appends(['year_id' => $request->year_id]) : '';
        $pagination = (isset($request->grade_id)) ? $result->appends(['grade_id' => $request->grade_id]) : '';

        $years = Year::all();
        $grades = Grade::all();
        $classrooms = Classroom::all();

        $request->flash();

        return view('setstudents.index', compact('result', 'query', 'years', 'grades', 'classrooms', 'students', 'input', 'request'));
    }

    public function importStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'file' => 'required',
        ]);

        if($validator->fails()) {
          return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('file');

        //Validate CSV extension
        $extension = $request->file->getClientOriginalExtension();
        if ($extension != 'csv') {

            $notification = array(
              'message' => 'You insert '. strtoupper($extension) .' file. Please insert CSV file',
              'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        //Import File
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $filtered = array_pop($rows);
        $header = array_shift($rows);

        $count = count($rows);

        foreach($rows as $row) {
          $row = array_combine($header, $row);

          $students = Student::create([
                          'noId' => $row['ID'],
                          'noIdNational' => $row['ID National'],
                          'studentname' => $row['Name'],
                          'studentnick' => $row['Nick Name'],
                          'studentactive' => 1,
                          'user_id' => Auth::user()->id,
                          'created_at' => Carbon::now(),
                          'updated_at' => Carbon::now(),
                      ]);
        }
        //take all created item
        $lastStudent = Student::orderBy('id', 'desc')->take($count)->get();
        //get student_id
        $lastStudentIds = $lastStudent->sortBy('id')->pluck('id');

        foreach($rows as $index => $row) {
          $row = array_combine($header, $row);

          $years = Year::all()->pluck('id', 'yearname')->toArray();

          $grades = Grade::all()->pluck('id', 'gradename')->toArray();

          $studentyears = Studentyear::insert([
                          'student_id' => $lastStudentIds[$index],
                          'year_id' => $years[$row['Year']],
                          'semester_id' => 1,
                          'grade_id' => $grades[$row['Grade']],
                          'created_at' => Carbon::now(),
                          'updated_at' => Carbon::now(),
                      ]);

          $studentyears = Studentyear::insert([
                          'student_id' => $lastStudentIds[$index],
                          'year_id' => $years[$row['Year']],
                          'semester_id' => 2,
                          'grade_id' => $grades[$row['Grade']],
                          'created_at' => Carbon::now(),
                          'updated_at' => Carbon::now(),
                      ]);
        }

        $notification = array(
          'message' => 'Student data was successfully imported.',
          'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function setClassroom(Request $request) {

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
      }

      if (isset($request->grade_id)) {
      $students->where('grade_id', 'like',  "%{$request->grade_id}%");
      }

      $students->where('semester_id', 1);
      $crs->where('semester_id', 1);

      $request->flash();

      $years = Year::all();
      $grades = Grade::all();

      $results = $students->where('studentactive', 1)->orderBy('noId')->get();
      $classrooms = $crs->where('classroomactive', 1)->orderBy('classroomname')->get();

      return view('setstudents.setclassroom', compact('results', 'students', 'request', 'crs', 'classrooms', 'years', 'grades'));
    }

    public function allocateStudentCR(Request $request, $id) {
      $st = Studentyear::findOrFail($id);
      $class = Classroom::where('classroomname', $request->classroomname)->first();

      $st->classroom_id = $class->id;
      $st->update();

      $student = array(['index' => $request->index, 'classroomname' => $class->classroomname]);



      return response()->json($student);
    }

    public function allocateClassroom() {

        $id = Input::get('id');
        $sd = Input::get('student_id');
        $yr = Input::get('year_id');
        $gr = Input::get('grade_id');
        $cr = Input::get('classroom_id');

        $students = Studentyear::where('student_id', $sd)->where('year_id', $yr)->where('grade_id', $gr)->where('semester_id', '>=', 0)->get();

        foreach ($students as $index => $student) {
          $student->update([
            'classroom_id' => $cr,
          ]);
        }

        return response()->json($students);
    }

    public function addClassroom(Request $request, $id) {
        $student = Student::findOrFail($id);

        $semester = Semester::pluck('id');

        foreach ($semester as $index => $item) {
          $addcr = New Studentyear;
          $addcr->user_id = $request->user_id;
          $addcr->student_id = $id;
          $addcr->classroom_id = $request->classroom_id;
          $addcr->year_id = $request->year_id;
          $addcr->semester_id = $semester[$index];
          $addcr->grade_id = $request->grade_id;
          $addcr->classroom_id = $request->classroom_id;

          $addcr->save();
        }

        $notification = array(
          'message' => 'Classroom was successfully added.',
          'alert-type' => 'success'
        );

        return back()->with($notification);

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
        $student = Student::findOrFail($id);

        $hist = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->join('semesters', 'semesters.id', '=', 'studentyears.semester_id')
                        ->leftJoin('classrooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                        ->select('studentyears.id', 'studentyears.student_id', 'students.studentname', 'years.yearname', 'semesters.semestername', 'grades.gradename', 'classrooms.classroomname');

        $histories = $hist->where('student_id', $id)->get();
        $classrooms = Classroom::where('classroomactive', 1)->get();
        $years = Year::all();
        $grades = Grade::all();

        return view('setstudents.show', compact('student', 'hist', 'histories', 'classrooms', 'years', 'grades'));
    }

    public function delYear($id) {
        $student = Studentyear::findOrFail($id);

        $student->classroom_id = null;
        $student->update();

        $notification = array(
          'message' => 'Classroom was successfully deleted.',
          'alert-type' => 'warning'
        );

        return back()->with($notification);
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

    }
}
