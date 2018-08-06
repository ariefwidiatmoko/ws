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
use App\Competencyalpha;
use App\Competencysheet;
use App\Competency;
use App\Setscore;
use App\Setcompetency;
use App\Year;
use App\Yearactive;
use DB;
use Excel;

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

        return view('gradings.scoringsheets.index', compact('result'));
    }

    public function create()
    {
        $classrooms = Classroom::where('classroomactive', 1)->get();
        $semesters = Semester::all();
        $subjects = Subject::where('subjectactive', 1)->get();
        $years = Year::all();
        $yearactive = Yearactive::first();

        return view('gradings.scoringsheets.create', compact('classrooms', 'semesters', 'years', 'yearactive', 'subjects'));
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
              'message' => 'Classroom has no student, please go to Setting > Classroom-Student to make allocation first',
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
                $scoringsheet->type_id = 3;
                $scoringsheet->classsubject_id = $classsubject->id;
                $scoringsheet->created_by = Auth::user()->name;
                $scoringsheet->save();

                $scoringsheet = new Scoringsheet;
                $scoringsheet->csbatch_id = $newbatch_id;
                $scoringsheet->type_id = 4;
                $scoringsheet->classsubject_id = $classsubject->id;
                $scoringsheet->created_by = Auth::user()->name;
                $scoringsheet->save();

                $competencysheet = new Competencysheet;
                $competencysheet->csbatch_id = $newbatch_id;
                $competencysheet->type_id = 3;
                $competencysheet->classsubject_id = $classsubject->id;
                $competencysheet->created_by = Auth::user()->name;
                $competencysheet->save();

                $competencysheet = new Competencysheet;
                $competencysheet->csbatch_id = $newbatch_id;
                $competencysheet->type_id = 4;
                $competencysheet->classsubject_id = $classsubject->id;
                $competencysheet->created_by = Auth::user()->name;
                $competencysheet->save();
              }

              $setscore = new Setscore;
              $setscore->csbatch_id = $newbatch_id;
              $setscore->type_id = 3;
              $setscore->columnscore = $request->columnscore;
              $setscore->created_by = Auth::user()->name;
              $setscore->save();

              $setscore = new Setscore;
              $setscore->csbatch_id = $newbatch_id;
              $setscore->type_id = 4;
              $setscore->columnscore = $request->columnscore;
              $setscore->created_by = Auth::user()->name;
              $setscore->save();

              $setcompetency = new Setcompetency;
              $setcompetency->csbatch_id = $newbatch_id;
              $setcompetency->type_id = 3;
              $setcompetency->created_by = Auth::user()->name;
              $setcompetency->save();

              $setcompetency = new Setcompetency;
              $setcompetency->csbatch_id = $newbatch_id;
              $setcompetency->type_id = 4;
              $setcompetency->created_by = Auth::user()->name;
              $setcompetency->save();

          }

        }

        $notification = array(
          'message' => 'Scoringsheet successfully created',
          'alert-type' => 'success'
        );

        return redirect()->route('scoringsheets.showscore', [3, $newbatch_id])->with($notification);

    }

    public function showscore($type_id, $id)
    {
        if ($type_id == 3)
        {
            $peng = Type::where('id', $type_id)->first();
            $ketr = Type::where('id', 4)->first();
        }
        else
        {
            $peng = Type::where('id', 3)->first();
            $ketr = Type::where('id', $type_id)->first();
        }
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $details = Detail::all();
        $groups = Group::all();
        $group_ids = $groups->pluck('groupname', 'id')->all();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();
        $competency = Competency::where('subjectgradeyear_id', $classsubject->subject_id . $classroom->grade_id . $classsubject->year_id)->where('type_id', $type_id)->where('semester_id', $classsubject->semester_id)->first();
        $competencies = $competency->arraycompetency;

        $result = DB::table('classsubjects')
                    ->join('scoringsheets', 'scoringsheets.classsubject_id', '=', 'classsubjects.id')
                    ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                    ->join('students', 'students.id', '=', 'studentyears.student_id')
                    ->select('classsubjects.created_by', 'students.noId', 'students.studentname', 'scoringsheets.id', 'scoringsheets.arrayscore', 'scoringsheets.classsubject_id')
                    ->where('classsubjects.csbatch_id', $id)
                    ->where('type_id', $type_id)
                    ->get();

        $detail_avgs = $details->pluck('detailname', 'id')->toArray();
        $scoringsheets = Scoringsheet::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->get();
        $arrayscores = $scoringsheets->where('type_id', $type_id)->pluck('arrayscore', 'id')->toArray();
        $setcompetency = Setcompetency::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
        $arraycompetencies = $setcompetency->arraycompetency;
        $setscore = Setscore::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
        $arraydetails = collect($setscore->arraydetail)->toArray();
        $arraygroups = collect($setscore->arraygroup);
        $arraygroup_percentages = collect($setscore->arraygroup_percentage)->toArray();
        $arraydetail_avgs = collect($setscore->arraydetail_avg);
        $uniques = $arraydetail_avgs->unique()->values();
        //Select same detail to get average in array
        $avgs = array();
        for ($i = 0; $i < count($uniques); $i++) {
            $avgs[] = $arraydetail_avgs
                ->reject(function($arraydetail_avg) use ($uniques, $i) {
                    return str_contains($arraydetail_avg, $uniques[$i]) == false;
                });
        }

        $group_uniques = collect($arraygroups)->unique()->values();

        if (isset($arraygroups)) {
            $group_avgs = array();
            for ($i = 0; $i < count($group_uniques); $i++) {
                $group_avgs[] = $arraygroups
                    ->reject(function($arraygroups) use ($group_uniques, $i) {
                        return str_contains($arraygroups, $group_uniques[$i]) == false;
                    });
            }
        }


        return view('gradings.scoringsheets.show', compact('peng', 'ketr', 'classsubject', 'classroom', 'details', 'groups', 'group_ids', 'detail_avgs', 'subject', 'year', 'semester', 'competencies', 'result', 'arrayscores', 'arraycompetencies', 'setscore', 'arraydetails', 'arraygroups', 'arraygroup_percentages', 'uniques', 'avgs',
        'group_uniques', 'group_avgs'));
    }

    public function showcompetency($type_id, $id)
    {
        $peng = Type::where('id', $type_id)->first();
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $details = Detail::all();
        $groups = Group::all();
        $group_ids = $groups->pluck('groupname', 'id')->all();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();
        $competency = Competency::where('subjectgradeyear_id', $classsubject->subject_id . $classroom->grade_id . $classsubject->year_id)->where('type_id', $type_id)->where('semester_id', $classsubject->semester_id)->first();
        $competencies = $competency->arraycompetency;

        $result = DB::table('classsubjects')
                    ->join('scoringsheets', 'scoringsheets.classsubject_id', '=', 'classsubjects.id')
                    ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                    ->join('students', 'students.id', '=', 'studentyears.student_id')
                    ->select('classsubjects.created_by', 'students.noId', 'students.studentname', 'students.studentnick', 'scoringsheets.id', 'scoringsheets.arrayscore', 'scoringsheets.classsubject_id')
                    ->where('classsubjects.csbatch_id', $id)
                    ->where('type_id', $type_id)
                    ->get();

        $detail_avgs = $details->pluck('detailname', 'id')->toArray();
        $scoringsheets = Scoringsheet::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->get();
        $arrayscores = $scoringsheets->where('type_id', $type_id)->pluck('arrayscore', 'id')->toArray();
        $setscore = Setscore::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
        $arraydetails = collect($setscore->arraydetail)->toArray();
        $setcompetency = Setcompetency::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
        $arraycompetencies = collect($setcompetency->arraycompetency);
        $uniques = collect($setcompetency->arraycompetency_avg);
        //Select same detail to get average in array
        $avgs = array();
          for ($i = 0; $i < count($uniques); $i++) {
              $avgs[] = $arraycompetencies
                  ->reject(function($arraycompetencies) use ($uniques, $i) {
                      return str_contains($arraycompetencies, $uniques[$i]) == false;
                  });
          }
        //Competency Description
        $arrayscales = $competency->arrayscale;
        $arrayalphabets = $competency->arrayalphabet;
        //Alphabet Grade
        $array_alphabet = Competencyalpha::pluck('alphabet')->toArray();

        return view('gradings.scoringsheets.showcompetency', compact('peng', 'classsubject', 'classroom', 'details', 'groups', 'group_ids',
        'detail_avgs', 'subject', 'year', 'semester', 'competencies', 'array_average', 'array_alphabet', '$array_description', 'result', 'arrayscores', 'arraycompetencies', 'arraycompetency_avgs',
        'setscore', 'arraydetails', 'arraygroups', 'arraygroup_percentages', 'uniques', 'avgs', 'group_uniques', 'group_avgs', 'arrayscales',
        'arrayalphabets', 'array_alphabet'));
    }

    public function inputscore($type_id, $id)
    {
        $peng = Type::where('id', $type_id)->first();
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $details = Detail::all();
        $groups = Group::all();
        $group_ids = $groups->pluck('groupname', 'id')->all();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();
        $competency = Competency::where('subjectgradeyear_id', $classsubject->subject_id . $classroom->grade_id . $classsubject->year_id)->where('type_id', $type_id)->where('semester_id', $classsubject->semester_id)->first();
        $competencies = $competency->arraycompetency;
        $gradings = Grading::pluck('alphabet')->toArray();
        dd($gradings);

        $result = DB::table('classsubjects')
                    ->join('scoringsheets', 'scoringsheets.classsubject_id', '=', 'classsubjects.id')
                    ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                    ->join('students', 'students.id', '=', 'studentyears.student_id')
                    ->select('classsubjects.created_by', 'students.noId', 'students.studentname', 'scoringsheets.id', 'scoringsheets.arrayscore', 'scoringsheets.classsubject_id')
                    ->where('classsubjects.csbatch_id', $id)
                    ->where('type_id', $type_id)
                    ->get();

        $detail_avgs = $details->pluck('detailname', 'id')->toArray();
        $scoringsheets = Scoringsheet::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->get();
        $arrayscores = $scoringsheets->where('type_id', $type_id)->pluck('arrayscore', 'id')->toArray();
        $setcompetency = Setcompetency::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
        $arraycompetencies = $setcompetency->arraycompetency;
        $setscore = Setscore::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
        $arraydetails = collect($setscore->arraydetail)->toArray();
        $arraygroups = collect($setscore->arraygroup);
        $arraygroup_percentages = collect($setscore->arraygroup_percentage)->toArray();
        $arraydetail_avgs = collect($setscore->arraydetail_avg);
        $uniques = $arraydetail_avgs->unique()->values();
        //Select same detail to get average in array
        $avgs = array();
        for ($i = 0; $i < count($uniques); $i++) {
            $avgs[] = $arraydetail_avgs
                ->reject(function($arraydetail_avg) use ($uniques, $i) {
                    return str_contains($arraydetail_avg, $uniques[$i]) == false;
                });
        }

        $group_uniques = collect($arraygroups)->unique()->values();

        if (isset($arraygroups)) {
            $group_avgs = array();
            for ($i = 0; $i < count($group_uniques); $i++) {
                $group_avgs[] = $arraygroups
                    ->reject(function($arraygroups) use ($group_uniques, $i) {
                        return str_contains($arraygroups, $group_uniques[$i]) == false;
                    });
            }
        }

        return view('gradings.scoringsheets.input', compact('peng', 'classsubject', 'classroom', 'details', 'groups', 'group_ids', 'detail_avgs', 'subject', 'year', 'semester', 'competencies', 'result', 'arrayscores', 'arraycompetencies', 'setscore', 'arraydetails', 'arraygroups', 'arraygroup_percentages', 'uniques', 'avgs',
        'group_uniques', 'group_avgs'));
    }

    public function updatecolumndetail(Request $request, $id)
    {
        $columndetail = Setscore::where('csbatch_id', $id)->where('type_id', $request->type_id)->first();
        $detailname = Detail::pluck('detailname', 'id')->toArray();

        if (empty($columndetail->arraydetail)) {
            $array = array();
            $array[$request->index] = $detailname[$request->detailcolumn] . $request->detailnumber;
            $columndetail->arraydetail = $array;
            $array2 = array();
            $array2[$request->index] = $request->detailcolumn;
            $columndetail->arraydetail_avg = $array2;
            $columndetail->update();
         } else {
            $array = array_prepend($columndetail->arraydetail, $detailname[$request->detailcolumn] . $request->detailnumber, $request->index);
            $collections1 = collect($array)->sortKeys()->toArray();
            $columndetail->arraydetail = $collections1;

            $array2 = array_prepend($columndetail->arraydetail_avg, $request->detailcolumn, $request->index);
            $collections2 = collect($array2)->sortKeys()->toArray();
            $columndetail->arraydetail_avg = $collections2;
            $columndetail->update();

            $group = $columndetail->arraygroup;
            $percent = $columndetail->arraygroup_percentage;
            $uniques = collect($columndetail->arraydetail_avg)->unique()->toArray();
            if (isset($group) && count($group) > count($uniques)) {
               $intersect = array_intersect_key($group, $uniques);
               $intersect2 = array_intersect_key($percent, $uniques);
               $columndetail->arraygroup = $intersect;
               $columndetail->arraygroup_percentage = $intersect;
               $columndetail->update();
            }
         }

         return response()->json($columndetail);

    }

    public function updatecolumngroup(Request $request, $id) {
        $columngroup = Setscore::where('csbatch_id', $id)->where('type_id', $request->type_id)->first();
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
            $collections2 = collect($array2)->sortKeys()->toArray();
            $columngroup->arraygroup_percentage = $collections2;

            //Unique Values
            //$collections = collect($array)->sortKeys()->unique()->values();
         }

         $columngroup->update();

         return response()->json($columngroup);
    }

    public function updatecolumncompetency(Request $request, $id)
    {
          $classsubject = Classsubject::where('csbatch_id', $id)->first();
          $classroom = Classroom::findOrFail($classsubject->classroom_id);
          $setcompetency = Setcompetency::where('csbatch_id', $id)->where('type_id', $request->type_id)->first();
          if (empty($setcompetency->arraycompetency)) {
              $array = array();
              $array[$request->index] = $request->arraycompetency;
              $setcompetency->arraycompetency = $array;
              $setcompetency->arraycompetency_avg = $array;
              $setcompetency->update();
           } else {
              $array1 = array_prepend($setcompetency->arraycompetency, $request->arraycompetency, $request->index);
              $collections = collect($array1)->sortKeys()->toArray();
              $setcompetency->arraycompetency = $collections;
              $setcompetency->arraycompetency_avg = array_values(array_unique($collections));
              $setcompetency->update();
           }

           return response()->json($setcompetency);

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

    public function updatefscore(Request $request)
    {
          $finalscores = Scoringsheet::where('csbatch_id', $request->id)->where('type_id', $request->type_id)->get();

          foreach ($finalscores as $index => $item) {
            $item->typescore = $request->arrayfinals[$index];
            $item->update();
          }

          return response()->json($finalscores);

    }

    public function updatefcompetency(Request $request)
    {
          $finalcompetencies = Competencysheet::where('csbatch_id', $request->csbatch_id)->where('type_id', $request->type_id)->get();
          $data_average = json_decode($request->average);
          $data_alphabet = json_decode($request->alphabet);
          $data_description = json_decode($request->description);
          foreach ($finalcompetencies as $index => $item) {
            $item->arraycompetencyaverage = explode(",", $data_average[$index]);
            $item->arraycompetencygrade = explode(",", $data_alphabet[$index]);
            $item->competencydescription = $data_description[$index];
            $item->update();
          }

          return response()->json($finalcompetencies);

    }

    public function updatecolumnscore(Request $request, $id)
    {
        $columnscore = Setscore::where('csbatch_id', $id)->where('type_id', $request->type_id)->first();
        $columnscore->columnscore = $request->columnscore;
        $columnscore->update();

        return response()->json($columnscore);

    }

    public function setscore($id) {
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $details = Detail::all();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();

        return view('gradings.scoringsheets.setscore', compact('classsubject', 'classroom', 'details', 'subject', 'year', 'semester'));
    }

    public function exportscore($type_id, $id) {
        $type = Type::where('id', $type_id)->first();
        $classsubject = Classsubject::where('csbatch_id', $id)->first();
        $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
        $details = Detail::all();
        $groups = Group::all();
        $group_ids = $groups->pluck('groupname', 'id')->all();
        $subject = Subject::where('id', $classsubject->subject_id)->first();
        $year = Year::where('id', $classsubject->year_id)->first();
        $semester = Semester::where('id', $classsubject->semester_id)->first();
        $competency = Competency::where('subjectgradeyear_id', $classsubject->subject_id . $classroom->grade_id . $classsubject->year_id)->where('type_id', $type_id)->where('semester_id', $classsubject->semester_id)->first();
        $competencies = $competency->arraycompetency;

        $result = DB::table('classsubjects')
                    ->join('scoringsheets', 'scoringsheets.classsubject_id', '=', 'classsubjects.id')
                    ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                    ->join('students', 'students.id', '=', 'studentyears.student_id')
                    ->select('classsubjects.created_by', 'students.noId', 'students.studentname', 'scoringsheets.id', 'scoringsheets.arrayscore', 'scoringsheets.classsubject_id')
                    ->where('classsubjects.csbatch_id', $id)
                    ->where('type_id', $type_id)
                    ->get();

        $detail_avgs = $details->pluck('detailname', 'id')->toArray();
        $scoringsheets = Scoringsheet::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->get();
        $arrayscores = $scoringsheets->where('type_id', $type_id)->pluck('arrayscore', 'id')->toArray();
        $setcompetency = Setcompetency::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
        $arraycompetencies = $setcompetency->arraycompetency;
        $setscore = Setscore::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
        $arraydetails = collect($setscore->arraydetail)->toArray();
        $arraygroups = collect($setscore->arraygroup);
        $arraygroup_percentages = collect($setscore->arraygroup_percentage)->toArray();
        $arraydetail_avgs = collect($setscore->arraydetail_avg);
        $uniques = $arraydetail_avgs->unique()->values();
        //Select same detail to get average in array
        $avgs = array();
        for ($i = 0; $i < count($uniques); $i++) {
            $avgs[] = $arraydetail_avgs
                ->reject(function($arraydetail_avg) use ($uniques, $i) {
                    return str_contains($arraydetail_avg, $uniques[$i]) == false;
                });
        }

        $group_uniques = collect($arraygroups)->unique()->values();

        if (isset($arraygroups)) {
            $group_avgs = array();
            for ($i = 0; $i < count($group_uniques); $i++) {
                $group_avgs[] = $arraygroups
                    ->reject(function($arraygroups) use ($group_uniques, $i) {
                        return str_contains($arraygroups, $group_uniques[$i]) == false;
                    });
            }
        }

        \Excel::create('Scoring_Sheet_' . $subject->subjectname . '_' . $type->typedescription . '_' . $classroom->classroomname . '_' . $year->yearname . '_' . $semester->semestername, function($excel) use ($type_id, $id, $type, $classsubject, $classroom, $details, $groups, $group_ids, $subject, $year, $semester, $competency, $competencies, $result, $detail_avgs, $scoringsheets, $arrayscores, $setcompetency, $arraycompetencies, $setscore, $arraydetails,
        $arraygroups, $arraygroup_percentages, $arraydetail_avgs, $uniques, $avgs, $group_uniques, $group_avgs)
        {
            $excel->sheet('Scoring Sheet', function($sheet) use ($type_id, $id, $type, $classsubject, $classroom, $details, $groups, $group_ids, $subject, $year, $semester, $competency, $competencies, $result, $detail_avgs, $scoringsheets, $arrayscores, $setcompetency, $arraycompetencies, $setscore,
            $arraydetails, $arraygroups, $arraygroup_percentages, $arraydetail_avgs, $uniques, $avgs, $group_uniques, $group_avgs)
            {
                $sheet->loadView('gradings.scoringsheets.exportscore')->with('arraydetails', $arraydetails)
                      ->with('setscore', $setscore)->with('uniques', $uniques)->with('arraygroups', $arraygroups)
                      ->with('group_ids', $group_ids)->with('group_uniques', $group_uniques)->with('detail_avgs', $detail_avgs)
                      ->with('result', $result)->with('avgs', $avgs)->with('arrayscores', $arrayscores)->with('group_avgs', $group_avgs)
                      ->with('type', $type)->with('arraycompetencies', $arraycompetencies)->with('arraygroup_percentages', $arraygroup_percentages)
                      ->with('subject', $subject)->with('classroom', $classroom)->with('year', $year)->with('semester', $semester);
            });
        })->download('xls');
    }

    public function exportcompetency($type_id, $id) {

          $type = Type::where('id', $type_id)->first();
          $classsubject = Classsubject::where('csbatch_id', $id)->first();
          $classroom = Classroom::where('id', $classsubject->classroom_id)->first();
          $details = Detail::all();
          $groups = Group::all();
          $group_ids = $groups->pluck('groupname', 'id')->all();
          $subject = Subject::where('id', $classsubject->subject_id)->first();
          $year = Year::where('id', $classsubject->year_id)->first();
          $semester = Semester::where('id', $classsubject->semester_id)->first();
          $competency = Competency::where('subjectgradeyear_id', $classsubject->subject_id . $classroom->grade_id . $classsubject->year_id)->where('type_id', $type_id)->where('semester_id', $classsubject->semester_id)->first();
          $competencies = $competency->arraycompetency;
          $competencysheets = Competencysheet::where('csbatch_id', $id)->where('type_id', $type_id)->get();
          $array_average = $competencysheets->pluck('arraycompetencyaverage')->toArray();
          $array_grade = $competencysheets->pluck('arraycompetencygrade')->toArray();
          $array_description = $competencysheets->pluck('competencydescription')->toArray();

          $result = DB::table('classsubjects')
                      ->join('scoringsheets', 'scoringsheets.classsubject_id', '=', 'classsubjects.id')
                      ->join('studentyears', 'studentyears.id', '=', 'classsubjects.studentyear_id')
                      ->join('students', 'students.id', '=', 'studentyears.student_id')
                      ->select('classsubjects.created_by', 'students.noId', 'students.studentname', 'students.studentnick', 'scoringsheets.id', 'scoringsheets.arrayscore', 'scoringsheets.classsubject_id')
                      ->where('classsubjects.csbatch_id', $id)
                      ->where('type_id', $type_id)
                      ->get();

          $detail_avgs = $details->pluck('detailname', 'id')->toArray();
          $scoringsheets = Scoringsheet::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->get();
          $arrayscores = $scoringsheets->where('type_id', $type_id)->pluck('arrayscore', 'id')->toArray();
          $setscore = Setscore::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
          $arraydetails = collect($setscore->arraydetail)->toArray();
          $setcompetency = Setcompetency::where('csbatch_id', $classsubject->csbatch_id)->where('type_id', $type_id)->first();
          $arraycompetencies = collect($setcompetency->arraycompetency);
          $uniques = collect($setcompetency->arraycompetency_avg);
          //Select same detail to get average in array
          $avgs = array();
            for ($i = 0; $i < count($uniques); $i++) {
                $avgs[] = $arraycompetencies
                    ->reject(function($arraycompetencies) use ($uniques, $i) {
                        return str_contains($arraycompetencies, $uniques[$i]) == false;
                    });
            }
          //Competency Description
          $arrayscales = $competency->arrayscale;
          $arrayalphabets = $competency->arrayalphabet;
          //Alphabet Grade
          $array_alphabet = Competencyalpha::pluck('alphabet')->toArray();
          //Get Column Excel for wrap description
          $count_arraycompetencies = count($setcompetency->arraycompetency);
          $count_arraycompetency_avgs = count($setcompetency->arraycompetency_avg);
          $col_excel = 3 + $count_arraycompetencies + (2 * $count_arraycompetency_avgs);
          //Get Row Excel for wrap description
          $count_result = count($result);
          $row_start = 7;
          $row_end = 6 + $count_result;
          $col_alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

          \Excel::create('Competency_Sheet_' . $subject->subjectname . '_' . $type->typedescription . '_' . $classroom->classroomname . '_' . $year->yearname . '_' . $semester->semestername, function($excel) use (
            $type_id, $id, $type, $classsubject, $classroom, $details, $groups, $group_ids, $subject, $year, $semester, $competency, $competencies, $array_average,
            $array_grade, $array_description, $result, $detail_avgs, $scoringsheets, $arrayscores, $setscore, $arraydetails, $setcompetency, $arraycompetencies,
            $uniques, $avgs, $arrayscales, $arrayalphabets, $array_alphabet, $col_alphabet, $col_excel, $row_start, $row_end)
          {
              $excel->sheet('Competency Sheet', function($sheet) use ($type_id, $id, $type, $classsubject, $classroom, $details, $groups, $group_ids, $subject, $year, $semester, $competency, $competencies, $array_average, $array_grade, $array_description, $result, $detail_avgs, $scoringsheets,
              $arrayscores, $setscore, $arraydetails, $setcompetency, $arraycompetencies, $uniques, $avgs, $arrayscales, $arrayalphabets, $array_alphabet, $col_alphabet, $col_excel, $row_start, $row_end)
              {
                  $sheet->getStyle($col_alphabet[$col_excel] . $row_start . ':' . $col_alphabet[$col_excel] . $row_end)->getAlignment()->setWrapText(true);
                  $sheet->loadView('gradings.scoringsheets.exportcompetency')->with('type', $type)
                        ->with('subject', $subject)->with('classroom', $classroom)->with('year', $year)->with('result', $result)
                        ->with('semester', $semester)->with('avgs', $avgs)->with('array_average', $array_average)->with('array_grade', $array_grade)
                        ->with('array_description', $array_description)->with('arraydetails', $arraydetails)->with('arrayscores', $arrayscores)
                        ->with('arraysc', $arrayscales)->with('array_alphabet', $array_alphabet)->with('arrayalphabets', $arrayalphabets)
                        ->with('uniques', $uniques);
              });
          })->download('xls');
    }

    public function destroy($id) {
        //
    }
}
