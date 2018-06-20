<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Classroom;
use App\Classsubject;
use App\Detail;
use App\Group;
use App\Groupscore;
use Input;
use Illuminate\Http\Request;
use App\Semester;
use App\Studentyear;
use App\Subject;
use App\Type;
use App\Typescore;
use App\Worksheet;
use App\Year;
use App\Yearactive;
use DB;

class WorksheetController extends Controller
{

    public function index()
    {
        $result = DB::table('classsubjects')
                           ->join('subjects', 'subjects.id', '=', 'classsubjects.subject_id')
                           ->join('years', 'years.id', '=', 'classsubjects.year_id')
                           ->join('semesters', 'semesters.id', '=', 'classsubjects.semester_id')
                           ->join('classrooms', 'classrooms.id', '=', 'classsubjects.classroom_id')
                           ->select('classsubjects.id', 'classsubjects.csbatch_id', 'classsubjects.created_by', '.classsubjects.updated_by', 'classsubjects.created_at', 'classsubjects.updated_at', 'classrooms.classroomname', 'subjects.subjectname', 'years.yearname', 'semesters.semestername')->groupBy('subject_id')->paginate(20);

        return view('scorings.worksheets.index', compact('result'));
    }

    public function create()
    {
        $classrooms = Classroom::where('classroomactive', 1)->get();
        $semesters = Semester::all();
        $subjects = Subject::where('subjectactive', 1)->get();
        $years = Year::all();
        $yearactive = Yearactive::first();

        return view('scorings.worksheets.create', compact('classrooms', 'semesters', 'years', 'yearactive', 'subjects'));
    }

    public function store(Request $request)
    {

         //Get Student-Class list
        $studentlists = Studentyear::where('year_id', $request->year_id)->where('semester_id', $request->semester_id)->where('classroom_id', $request->classroom_id)->get();

        if($studentlists->isEmpty()) {

            $notification = array(
              'message' => 'Classroom has no student, please make Classroom-Student Allocation',
              'alert-type' => 'error'
            );

            $request->flash();

            return back()->with($notification);

        } else {

          $subject_id = Classsubject::where('subject_id', $request->subject_id)->where('year_id', $request->year_id)->where('semester_id', $request->semester_id)->where('classroom_id', $request->classroom_id)->first();
          $subject = Subject::all();
          $subjectname = $subject->pluck('subjectname', 'id')->toArray();

          $classsubject_batch_id = Classsubject::orderBy('csbatch_id', 'desc')->pluck('csbatch_id')->first();

          $newbatch_id = $classsubject_batch_id + 1;

          if(isset($subject_id)) {

              $notification = array(
                'message' => 'Scoringsheet ' . $subjectname[$request->subject_id] . ' already existed',
                'alert-type' => 'error'
              );

              $request->flash();

              return redirect()->route('worksheets.create')->with($notification);

          } else {
              //Get studentyear_id
              $student_ids = $studentlists->pluck('id');
              $student_batch_id = $studentlists->pluck('sybatch_id')->first();

              foreach ($student_ids as $index => $item) {
                  $classsubject = new Classsubject;
                  $classsubject->csbatch_id = $newbatch_id;
                  $classsubject->year_id = $request->year_id;
                  $classsubject->semester_id = $request->semester_id;
                  $classsubject->classroom_id = $request->classroom_id;
                  $classsubject->subject_id = $request->subject_id;
                  $classsubject->studentyear_id = $item;
                  $classsubject->created_by = Auth::user()->name;
                  $classsubject->save();

                  $worksheet = new Worksheet;
                  $worksheet->wsbatch_id = $newbatch_id;
                  $worksheet->columnscoring = $request->columnscoring;
                  $worksheet->classsubject_id = $classsubject->id;
                  $worksheet->created_by = Auth::user()->name;
                  $worksheet->save();

              }

          }

        }

        $notification = array(
          'message' => 'Worksheet successfully created',
          'alert-type' => 'success'
        );

        return redirect()->route('worksheets.show', $newbatch_id)->with($notification);

    }

    public function show($id)
    {
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();

        $result = DB::table('classsubjects')->join('worksheets', 'worksheets.classsubject_id', '=', 'classsubjects.id')
                                            ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                                            ->join('students', 'students.id', '=', 'studentyears.student_id')
                                            ->select('classsubjects.id', 'students.noId', 'students.studentname', 'worksheets.columnscoring')
                                            ->where('classsubjects.csbatch_id', $id)
                                            ->paginate(100);

        $worksheets = Worksheet::where('wsbatch_id', $classsubject->csbatch_id);
        $arrayscorings = $worksheets->pluck('arrayscoring', 'id')->toArray();
        $worksheet = $worksheets->first();
        $arraydetails = array_sort($worksheet->arraydetail);
        $paddingbottom = [
                      5 => '10px',
                      10 => '16px',
                      15 => '10px',
                      20 => '10px',
                      30 => '10px',
                      40 => '10px',
                      50 => '16px',
                    ];

        return view('scorings.worksheets.show', compact('arraydetails', 'arrayscorings', 'classroom', 'classsubject', 'paddingbottom', 'result', 'subject', 'semester', 'worksheet', 'worksheets', 'year'));
    }

    public function inputscore($id)
    {
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $details = Detail::all();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();

        $result = DB::table('classsubjects')->join('worksheets', 'worksheets.classsubject_id', '=', 'classsubjects.id')
                                                   ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                                                   ->join('students', 'students.id', '=', 'studentyears.student_id')
                                                   ->select('classsubjects.created_by', 'students.noId', 'students.studentname', 'worksheets.id', 'worksheets.arrayscoring', 'worksheets.classsubject_id', 'worksheets.columnscoring')
                                                   ->where('classsubjects.csbatch_id', $id)
                                                   ->paginate(100);

        $worksheets = Worksheet::where('wsbatch_id', $classsubject->csbatch_id);
        $arrayscorings = $worksheets->pluck('arrayscoring', 'id')->toArray();
        $worksheet = $worksheets->first();
        $arraydetails = array_sort($worksheet->arraydetail);

        return view('scorings.worksheets.input', compact('arrayscorings', 'classsubject', 'classroom', 'details', 'subject', 'year', 'semester', 'result', 'worksheet', 'arraydetails'));
    }

    public function updatecolumnscore(Request $request, $id)
    {
        $worksheets = Worksheet::where('wsbatch_id', $id)->get();
        $worksheet_ids = $worksheets->pluck('id');

        foreach ($worksheet_ids as $index => $item) {
            $worksheet = Worksheet::findOrFail($item);

            if (empty($worksheet->arraydetail)) {
                $array = array();
                $array[$request->index] = $request->detailscore . $request->detailnumber;
                $worksheet->arraydetail = $array;
             } else {
                $array = array_prepend($worksheet->arraydetail, $request->detailscore . $request->detailnumber, $request->index);
                $worksheet->arraydetail = $array;
             }

            $worksheet->update();
         }

         return response()->json($worksheet);

    }

    public function updatescore(Request $request)
    {
          $worksheet = Worksheet::findOrFail($request->id);

          if (empty($worksheet->arrayscoring)) {
              $array = array();
              $array[$request->index] = $request->name;
              $worksheet->arrayscoring = $array;
           } else {
              $array = array_prepend($worksheet->arrayscoring, $request->name, $request->index);
              $worksheet->arrayscoring = $array;
           }

          $worksheet->update();

          return response()->json($worksheet);

    }

    public function destroy($id)
    {
        //
    }
}
