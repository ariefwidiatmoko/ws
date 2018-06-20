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

class ImportstudentController extends Controller
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

        return view('settings.importstudents.index', compact('result', 'query', 'years', 'grades', 'classrooms', 'students', 'input', 'request'));
    }

    public function import(Request $request) {
        $validator = Validator::make($request->all(), [ 'file' => 'required', ]);

        if($validator->fails()) {
          return redirect()->back()->withErrors($validator);
        } else {
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
          //For handle Duplication Entry Error
          try{

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

          }catch(\Exception $exception) {

                $notification = array(
                  'message' => 'Database error! Duplication entry found. Error Code ' . $exception->getCode(),
                  'alert-type' => 'warning'
                );

                return redirect()->back()->with($notification);
            }
        }

        //take all created item
        $lastStudents = Student::orderBy('id', 'desc')->take($count)->get();
        //get student_id
        $lastStudentIds = $lastStudents->sortBy('id')->pluck('id');

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
    }

    public function allocateStudentCR(Request $request, $id) {
      $st = Studentyear::findOrFail($id);
      $class = Classroom::where('classroomname', $request->classroomname)->first();

      $st->classroom_id = $class->id;
      $st->update();

      $student = array(['index' => $request->index, 'classroomname' => $class->classroomname]);

      return response()->json($student);
    }
}
