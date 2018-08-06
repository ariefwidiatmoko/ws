<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Subject;
use App\Grade;
use App\Type;
use App\Year;
use App\Semester;
use App\Yearactive;
use App\Competency;
use App\Competencyalpha;
use App\Student;
use DB;

class CompetencyController extends Controller
{
    public function index()
    {
      $subjects = Subject::pluck('subjectname', 'id')->toArray();
      $types = Type::pluck('typedescription', 'id')->toArray();
      $grades = Grade::pluck('gradename', 'id')->toArray();
      $years = Year::pluck('yearname', 'id')->all();
      $yearactive = Yearactive::first();
      $result = Competency::where('year_id', $yearactive->year_id)->groupBy('subjectgradeyear_id')->paginate(25);

      return view('gradings.competencies.index', compact('subjects', 'grades', 'years', 'result'));
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
          $subjects = Subject::pluck('id', 'subjectname')->toArray();
          $types = Type::pluck('id', 'typedescription')->toArray();
          $grades = Grade::pluck('id', 'gradename')->toArray();
          $years = Year::pluck('id', 'yearname')->toArray();
          $semesters = Semester::pluck('id', 'alias')->toArray();
          $competencyalphas = Competencyalpha::pluck('description')->toArray();
          $competencyscales = Competencyalpha::pluck('score')->toArray();

        foreach($rows as $row) {
          $row = array_combine($header, $row);

          //For handle Duplication Entry Error
          try{
              //make array from input competency
              $arraycompetency = array_filter(array_map('trim',explode("#",$row['Competency'])));
              //make description for each competency
              $array_desc1 = array();
              $array_scale1 = array();
              foreach ($arraycompetency as $item1) {
                  $array_desc2 = array();
                  $array_scale2 = array();
                  foreach ($competencyalphas as $index => $item2) {
                    $desc2 = $item2." ".$item1;
                    $array_desc2[] = $desc2;
                    $array_scale2[] = $competencyscales[$index];
                  }
                  $array_desc1[] = $array_desc2;
                  $array_scale1[] = $array_scale2;
                }

              $competency = Competency::create([
                            'subjectgradeyear_id' => $subjects[trim(preg_replace('/\s+/',' ', $row['Subject']))].
                            $grades[trim(preg_replace('/\s+/',' ', $row['Grade']))].
                            $years[trim(preg_replace('/\s+/',' ', $row['Year']))],
                            'subject_id' => $subjects[trim(preg_replace('/\s+/',' ', $row['Subject']))],
                            'arrayscale' => $array_scale1,
                            'arraycompetency' => $arraycompetency,
                            'arrayalphabet' => $array_desc1,
                            'type_id' => $types[trim(preg_replace('/\s+/',' ', $row['Type']))],
                            'grade_id' => $grades[trim(preg_replace('/\s+/',' ', $row['Grade']))],
                            'year_id' => $years[trim(preg_replace('/\s+/',' ', $row['Year']))],
                            'semester_id' => $semesters[trim(preg_replace('/\s+/',' ', $row['Semester']))],
                            'created_by' => Auth::user()->name,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
          }catch(\Exception $exception) {

                $notification = array(
                  'message' => 'Database error! can not proccess the CSV file. Error Code ' . $exception->getCode(),
                  'alert-type' => 'warning'
                );

                return redirect()->back()->with($notification);
            }
        }

        $notification = array(
          'message' => 'Subject Competencies data was successfully imported.',
          'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        }
    }

    public function show($type_id, $subjectgradeyear_id)
    {
        $peng = Type::where('id', 3)->first();
        $ketr = Type::where('id', 4)->first();
        $kd = Type::where('id', $type_id)->first();
        $alphabets = Competencyalpha::all();
        $alphascores = $alphabets->pluck('score')->toArray();
        $alphas = $alphabets->pluck('alphabet')->toArray();
        $competencies = Competency::where('subjectgradeyear_id', $subjectgradeyear_id)->where('type_id', $type_id)->get();
        $competencyfirst = $competencies->first();
        $semesterId1 = $competencies->where('semester_id', 1)->first();
        $semesterh1 = $semesterId1->arraycompetency;
        $semesterscale1 = $semesterId1->arrayscale;
        $semester1 = $semesterId1->arrayalphabet;
        $semesterId2 = $competencies->where('semester_id', 2)->first();
        $semesterh2 = $semesterId2->arraycompetency;
        $semesterscale2 = $semesterId2->arrayscale;
        $semester2 = $semesterId2->arrayalphabet;
        $subject = Subject::where('id', $competencyfirst->subject_id)->first();
        $type = Type::where('id', $type_id)->first();
        $grade = Grade::where('id', $competencyfirst->grade_id)->first();
        $year = Year::where('id', $competencyfirst->year_id)->first();
        $array_semester = collect($competencies->pluck('semester_id')->toArray())->unique()->values();

        return view('gradings.competencies.show', compact('peng', 'ketr', 'kd', 'alphascores', 'alphas', 'competencies', 'competencyfirst', 'semesterId1', 'semesterh1', 'semesterscale1', 'semester1', 'semesterId2', 'semesterh2', 'semesterscale2', 'semester2', 'subject', 'type', 'grade', 'year'));

    }

    public function updatehead(Request $request)
    {
        $competency = Competency::findOrFail($request->id);
        $competencyalphas = Competencyalpha::pluck('description')->toArray();
        $arrayalpha = $competency->arrayalphabet;
        $arraycomp = $competency->arraycompetency;

        $arraydetails = array();
        foreach ($competencyalphas as $item) {
          $comp = $item . ' ' . strtolower($request->headcomp);
          $arraydetails[] = $comp;
        }
        $addcompetencyalphas = array($request->index => $arraydetails);
        $newcompetencyalphas = array_replace($arrayalpha, $addcompetencyalphas);
        $competency->arrayalphabet = $newcompetencyalphas;

        $addarraycomp = array($request->index => strtolower($request->headcomp));
        $newarraycomp = array_replace($arraycomp, $addarraycomp);
        $competency->arraycompetency = $newarraycomp;
        $competency->update();

        return response()->json($competency);

    }

    public function updatescale(Request $request)
    {
      $arraynumb = array_map('trim',explode(";",$request->scalecomp));
      $competency = Competency::findOrFail($request->id);
      $arrayscale = $competency->arrayscale[$request->index1];
      $addscale = array($request->index2 => $arraynumb);
      $newdetail = array_replace($arrayscale, $addscale);
      $newarraycomp = array_replace($competency->arrayscale, array($request->index1 => $newdetail));
      $competency->arrayscale = $newarraycomp;
      $competency->update();

      return response()->json($competency);
    }

    public function updatedetail(Request $request)
    {
      $competency = Competency::findOrFail($request->id);
      $arraydetail = $competency->arrayalphabet[$request->index1];
      $adddetail = array($request->index2 => $request->detailcomp);
      $newdetail = array_replace($arraydetail, $adddetail);
      $newarraycomp = array_replace($competency->arrayalphabet, array($request->index1 => $newdetail));
      $competency->arrayalphabet = $newarraycomp;
      $competency->update();

      return response()->json($competency);
    }

    public function destroy($id)
    {
      $competencies = Competency::where('subjectgradeyear_id', $id)->get();
      $competency = $competencies->first();
      $subject_id = $competency->subject_id;
      $subjects = Subject::all();
      $subjectnames = $subjects->pluck('subjectname', 'id');

      foreach ($competencies as $key => $item) {
        $item->delete();
      }

      $notification = array(
        'message' => ucwords($subjectnames[$subject_id]) . ' competency was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('competencies.index')->with($notification);
    }
}
