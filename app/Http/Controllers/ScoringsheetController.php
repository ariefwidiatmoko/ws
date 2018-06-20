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
use App\Scoringsheet;
use App\Setscore;
use App\Year;
use App\Yearactive;
use DB;

class ScoringsheetController extends Controller
{

    public function index()
    {
        $result = DB::table('classsubjects')
                    ->join('subjects', 'subjects.id', '=', 'classsubjects.subject_id')
                    ->join('years', 'years.id', '=', 'classsubjects.year_id')
                    ->join('semesters', 'semesters.id', '=', 'classsubjects.semester_id')
                    ->join('classrooms', 'classrooms.id', '=', 'classsubjects.classroom_id')
                    ->select('classsubjects.id', 'classsubjects.csbatch_id', 'classsubjects.created_by', '.classsubjects.updated_by', 'classsubjects.created_at', 'classsubjects.updated_at', 'classrooms.classroomname', 'subjects.subjectname', 'years.yearname', 'semesters.semestername')
                    ->groupBy('subject_id')
                    ->paginate(20);

        return view('scorings.scoringsheets.index', compact('result'));
    }

    public function create()
    {
        $classrooms = Classroom::where('classroomactive', 1)->get();
        $semesters = Semester::all();
        $subjects = Subject::where('subjectactive', 1)->get();
        $years = Year::all();
        $yearactive = Yearactive::first();

        return view('scorings.scoringsheets.create', compact('classrooms', 'semesters', 'years', 'yearactive', 'subjects'));
    }

    public function store(Request $request)
    {
        //Check if There is Student-Classroom
        $studentlist = Studentyear::where('year_id', $request->year_id)
                                  ->where('semester_id', $request->semester_id)
                                  ->where('classroom_id', $request->classroom_id)
                                  ->first();

        if(empty($studentlist)) {

            $notification = array(
              'message' => 'Classroom has no student, please make Classroom-Student Allocation first',
              'alert-type' => 'error'
            );

            $request->flash();

            return back()->with($notification);

        } else {
          //Check if Scoringsheet already exist
          $scoringsheet = Classsubject::where('year_id', $request->year_id)
                                      ->where('semester_id', $request->semester_id)
                                      ->where('classroom_id', $request->classroom_id)
                                      ->where('subject_id', $request->subject_id)
                                      ->first();

          if(isset($scoringsheet)) {
              $subject = Subject::all();
              $subjectname = $subject->pluck('subjectname', 'id')->toArray();

              $notification = array(
                'message' => 'Scoringsheet ' . $subjectname[$request->subject_id] . ' already existed',
                'alert-type' => 'error'
              );

              $request->flash();

              return redirect()->route('scoringsheets.create')->with($notification);

          } else {
              //New Batch Id
              $classsubject_batch_id = Classsubject::orderBy('csbatch_id', 'desc')->pluck('csbatch_id')->first();
              $newbatch_id = $classsubject_batch_id + 1;

              //Get studentyear_id
              $student_ids = Studentyear::where('year_id', $request->year_id)->where('semester_id', $request->semester_id)->where('classroom_id', $request->classroom_id)->pluck('id');

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

                $scoringsheet = new Scoringsheet;
                $scoringsheet->csbatch_id = $newbatch_id;
                $scoringsheet->classsubject_id = $classsubject->id;
                $scoringsheet->created_by = Auth::user()->name;
                $scoringsheet->save();
              }

              $setscore = new Setscore;
              $setscore->csbatch_id = $newbatch_id;
              $setscore->columnscore = $request->columnscore;
              $setscore->created_by = Auth::user()->name;
              $setscore->save();

          }

        }

        $notification = array(
          'message' => 'Scoringsheet successfully created',
          'alert-type' => 'success'
        );

        return redirect()->route('scoringsheets.show', $newbatch_id)->with($notification);

    }

    public function show($id)
    {
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();

        $result = DB::table('classsubjects')->join('scoringsheets', 'scoringsheets.classsubject_id', '=', 'classsubjects.id')
                                            ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                                            ->join('students', 'students.id', '=', 'studentyears.student_id')
                                            ->select('classsubjects.id', 'students.noId', 'students.studentname', 'scoringsheets.arrayscore', 'scoringsheets.arrayscore_avg')
                                            ->where('classsubjects.csbatch_id', $id)
                                            ->paginate(100);

        $scoringsheets = Scoringsheet::where('csbatch_id', $classsubject->csbatch_id);
        $arrayscores = $scoringsheets->pluck('arrayscore', 'id')->toArray();
        $setscore = Setscore::where('csbatch_id', $classsubject->csbatch_id)->first();
        $arraydetails = array_sort($setscore->arraydetail);

        return view('scorings.scoringsheets.show', compact('arraydetails', 'arrayscores', 'classroom', 'classsubject', 'result', 'subject', 'semester', 'setscore', 'scoringsheets', 'year'));
    }

    public function showfullscreen($id)
    {
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();

        $result = DB::table('classsubjects')->join('scoringsheets', 'scoringsheets.classsubject_id', '=', 'classsubjects.id')
                                            ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                                            ->join('students', 'students.id', '=', 'studentyears.student_id')
                                            ->select('classsubjects.id', 'students.noId', 'students.studentname', 'scoringsheets.arrayscore', 'scoringsheets.arrayscore_avg')
                                            ->where('classsubjects.csbatch_id', $id)
                                            ->paginate(100);

        $scoringsheets = Scoringsheet::where('csbatch_id', $classsubject->csbatch_id);
        $arrayscores = $scoringsheets->pluck('arrayscore', 'id')->toArray();
        $setscore = Setscore::where('csbatch_id', $classsubject->csbatch_id)->first();
        $arraydetails = array_sort($setscore->arraydetail);

        return view('scorings.scoringsheets.showfullscreen', compact('arraydetails', 'arrayscores', 'classroom', 'classsubject', 'result', 'subject', 'semester', 'setscore', 'scoringsheets', 'year'));
    }

    public function inputscore($id)
    {
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $details = Detail::all();
        $groups = Group::all();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();

        $result = DB::table('classsubjects')
                    ->join('scoringsheets', 'scoringsheets.classsubject_id', '=', 'classsubjects.id')
                    ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                    ->join('students', 'students.id', '=', 'studentyears.student_id')
                    ->select('classsubjects.created_by', 'students.noId', 'students.studentname', 'scoringsheets.id', 'scoringsheets.arrayscore', 'scoringsheets.classsubject_id')
                    ->where('classsubjects.csbatch_id', $id)
                    ->paginate(100);


        $detail_avgs = $details->pluck('detailname', 'id')->toArray();
        $scoringsheets = Scoringsheet::where('csbatch_id', $classsubject->csbatch_id);
        $arrayscores = $scoringsheets->pluck('arrayscore', 'id')->toArray();
        $setscore = Setscore::where('csbatch_id', $classsubject->csbatch_id)->first();
        $arraydetails = collect($setscore->arraydetail)->toArray();
        $arraygroups = collect($setscore->arraygroup)->toArray();
        $arraygroup_percentages = collect($setscore->arraygroup_percentage)->toArray();
        $arraydetail_avgs = collect($setscore->arraydetail_avg);
        $uniques = $arraydetail_avgs->unique()->values();

        $avgs = array();
        for ($i = 0; $i < count($uniques); $i++) {
            $avgs[] = $arraydetail_avgs
                ->reject(function($arraydetail_avg) use ($uniques, $i) {
                    return str_contains($arraydetail_avg, $uniques[$i]) == false; });
        }

        return view('scorings.scoringsheets.input', compact('classsubject', 'classroom', 'details', 'groups', 'detail_avgs', 'subject', 'year', 'semester', 'result', 'arrayscores', 'setscore', 'arraydetails', 'arraygroups', 'arraygroup_percentages', 'uniques', 'avgs'));
    }

    public function inputfullscreen($id)
    {
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $details = Detail::all();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();

        $result = DB::table('classsubjects')
                    ->join('scoringsheets', 'scoringsheets.classsubject_id', '=', 'classsubjects.id')
                    ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                    ->join('students', 'students.id', '=', 'studentyears.student_id')
                    ->select('classsubjects.created_by', 'students.noId', 'students.studentname', 'scoringsheets.id', 'scoringsheets.arrayscore', 'scoringsheets.classsubject_id')
                    ->where('classsubjects.csbatch_id', $id)
                    ->paginate(100);


        $detail_avgs = $details->pluck('detailname', 'id')->toArray();
        $scoringsheets = Scoringsheet::where('csbatch_id', $classsubject->csbatch_id);
        $arrayscores = $scoringsheets->pluck('arrayscore', 'id')->toArray();
        $setscore = Setscore::where('csbatch_id', $classsubject->csbatch_id)->first();
        $arraydetails = collect($setscore->arraydetail)->toArray();
        $arraydetail_avgs = collect($setscore->arraydetail_avg);
        $uniques = $arraydetail_avgs->unique()->values();

        $avgs = array();
        for ($i = 0; $i < count($uniques); $i++) {
            $avgs[] = $arraydetail_avgs
                ->reject(function($arraydetail_avg) use ($uniques, $i) {
                    return str_contains($arraydetail_avg, $uniques[$i]) == false; });
        }

        return view('scorings.scoringsheets.inputfullscreen', compact('classsubject', 'classroom', 'details', 'detail_avgs', 'subject', 'year', 'semester', 'result', 'arrayscores', 'setscore', 'arraydetails', 'uniques', 'avgs'));
    }

    public function updatecolumndetail(Request $request, $id)
    {
        $columndetail = Setscore::where('csbatch_id', $id)->first();
        $detailname = Detail::pluck('detailname', 'id')->toArray();

        if (empty($columndetail->arraydetail)) {
            $array = array();
            $array[$request->index] = $detailname[$request->detailcolumn] . $request->detailnumber;
            $columndetail->arraydetail = $array;
            $array2 = array();
            $array2[$request->index] = $request->detailcolumn;
            $columndetail->arraydetail_avg = $array2;
         } else {
            $array = array_prepend($columndetail->arraydetail, $detailname[$request->detailcolumn] . $request->detailnumber, $request->index);
            $collections1 = collect($array)->sortKeys()->toArray();
            $columndetail->arraydetail = $collections1;

            $array2 = array_prepend($columndetail->arraydetail_avg, $request->detailcolumn, $request->index);
            $collections2 = collect($array2)->sortKeys()->toArray();
            $columndetail->arraydetail_avg = $collections2;

            //Unique Values
            //$collections = collect($array)->sortKeys()->unique()->values();
         }

         $columndetail->update();

         return response()->json($columndetail);

    }

    public function updatecolumngroup($id) {
        $columngroup = Setscore::where('csbatch_id', $id)->first();
        $groupname = Group::pluck('groupname', 'id')->toArray();

        if (empty($columngroup->arraygroup)) {
            $array = array();
            $array[$request->index] = $request->group;
            $columngroup->arraygroup = $array;
            $array2 = array();
            $array2[$request->index] = $request->grouppercentage;
            $columngroup->arraygroup_percentage = $array2;
         } else {
            $array = array_prepend($columngroup->arraygroup, $request->group, $request->index);
            $collections = collect($array)->sortKeys()->toArray();
            $columngroup->arraygroup = $collections;
            $array2 = array_prepend($columngroup->arraygroup_percentage, $request->grouppercentage, $request->index);
            $collections2 = collect($array)->sortKeys()->toArray();
            $columngroup->arraygroup_percentage = $collections2;

            //Unique Values
            //$collections = collect($array)->sortKeys()->unique()->values();
         }

         $columngroup->update();

         return response()->json($columngroup);
    }

    public function updatecolumncompetency($id) {
        $columnscore = Setscore::where('csbatch_id', $id)->first();
        $competencyname = Competency::pluck('competencyname', 'id')->toArray();

    }

    public function updatescore(Request $request)
    {
          $scoringsheet = Scoringsheet::findOrFail($request->id);

          if (empty($scoringsheet->arrayscore)) {
              $array = array();
              $array[$request->index] = $request->name;
              $scoringsheet->arrayscore = $array;
           } else {
              $array = array_prepend($scoringsheet->arrayscore, $request->name, $request->index);
              $collections = collect($array)->sortKeys()->toArray();
              $scoringsheet->arrayscore = $collections;
           }

          $scoringsheet->update();

          return response()->json($scoringsheet);

    }

    public function setscore($id) {
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $details = Detail::all();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();

        return view('scorings.scoringsheets.setscore', compact('classsubject', 'classroom', 'details', 'subject', 'year', 'semester'));
    }

    public function destroy($id) {
        //
    }
}
