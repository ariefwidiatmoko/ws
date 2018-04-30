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
use App\Grade;
use App\Classroom;
use App\Studentyear;
use DB;
class SetstudentController extends Controller
{

    public function index(Request $request)
    {

        $students = DB::table('students')
                        ->join('studentyears', 'students.id', '=', 'studentyears.student_id')->select('students.id', 'students.noId', 'students.noIdNational', 'students.fullname', 'studentyears.yearName', 'studentyears.gradeName', 'studentyears.semester_id');

        if (isset($request->search)) {
            $students->where('fullname', 'like',  "%{$request->search}%");
        }

        if (isset($request->yearName)) {
            $students->whereNull('yearName');

        }

        if (isset($request->gradeName)) {
        $students->whereNull('gradeName');
        }

        $result = $students->where('statusActive', 1)->orderBy('noId')->paginate(25);

        $pagination = (isset($request->search)) ? $result->appends(['name' => $request->search]) : '';

        $years = Year::all();
        $grades = Grade::all();
        $classrooms = Classroom::all();

        $request->flash();

        return view('setstudents.index', compact('result', 'query', 'years', 'grades', 'classrooms', 'students'));
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
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $filtered = array_pop($rows);
        $header = array_shift($rows);

        $count = count($rows);

        foreach($rows as $row) {
          $row = array_combine($header, $row);

          $students = Student::create([
                          'noId' => $row['noId'],
                          'noIdNational' => $row['noIdNational'],
                          'fullname' => $row['fullname'],
                          'nickName' => $row['nickName'],
                          'statusActive' => 1,
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

          $studentyears = Studentyear::insert([
                          'student_id' => $lastStudentIds[$index],
                          'yearName' => $row['yearName'],
                          'semester_id' => 1,
                          'gradeName' => $row['gradeName'],
                          'created_at' => Carbon::now(),
                          'updated_at' => Carbon::now(),
                      ]);

          $studentyears = Studentyear::insert([
                          'student_id' => $lastStudentIds[$index],
                          'yearName' => $row['yearName'],
                          'semester_id' => 2,
                          'gradeName' => $row['gradeName'],
                          'created_at' => Carbon::now(),
                          'updated_at' => Carbon::now(),
                      ]);
        }

        flash()->success('Students data was successfully saved.');

        return redirect()->back();
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
        $setstudent = Student::findOrFail($id);

        $classrooms = Classroom::all();
        $years = Year::all();
        $grades = Grade::all();

        return view('setstudents.show', compact('setstudent', 'classrooms', 'grades', 'years'));
    }

    public function delYear($id) {

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
