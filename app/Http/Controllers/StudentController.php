<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Image;
use Session;
use File;
use DB;
use App\Events\StudentCreated;
use App\Student;
use App\Studentprofile;
use App\Studentyear;
use App\Classroom;
use App\Classyear;
use App\Employee;
use App\Grade;
use App\Semester;
use App\Year;
use App\Yearactive;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $yearactive = Yearactive::first();
        $students = DB::table('studentyears')
                      ->leftJoin('students', 'students.id', '=', 'studentyears.student_id')
                      ->leftJoin('grades', 'grades.id', '=', 'studentyears.grade_id')
                      ->leftJoin('years', 'years.id', '=', 'studentyears.year_id')
                      ->leftJoin('classrooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                      ->leftJoin('semesters', 'semesters.id', '=', 'studentyears.semester_id')
                      ->select('noId', 'noIdNational', 'student_id', 'studentname', 'years.yearname', 'classrooms.classroomname', 'grades.gradename');


        //Default Index Classroom - Student showing Classroom - Student yearactive
        if(!isset($request->year_id)) {
            $students->where('year_id', 'like',  $yearactive->year_id);
        }

        if(isset($request->search)) {
            $students->where('classroomname', 'like',  "%{$request->search}%");
        }

        if(isset($request->year_id)) {
            $students->where('year_id', 'like',  $request->year_id);
        }

        if(isset($request->grade_id)) {
            $students->where('studentyears.grade_id', 'like',  $request->grade_id);
        }

        $years = Year::all();
        $grades = Grade::all();

        $request->flash();

        $result = $students->groupBy('student_id')->paginate(20);

        return view('academics.students.index', compact('grades', 'request', 'result', 'years', 'yearactive'));
    }

    //Academics > Students > Edit > Change Classroom
    public function updateAllocate(Request $request, $id) {
        $student = Studentyear::findOrFail($id);
        $class = Classroom::where('classroomname', $request->classroomname)->first();

        $student->classroom_id = $class->id;
        $student->yeargradeclassroom_id = $student->year_id . $student->grade_id . $student->classroom_id;
        $student->yearsemclassroom_id = $student->year_id . $student->semester_id . $student->classroom_id;
        $student->updated_by = Auth::user()->name;
        $student->update();

        return response()->json($student);

    }

    public function addyear(Request $request, $id)
    {
      $student = Student::findOrFail($id);
      $sys = Studentyear::all();
      $studentyear = $sys->where('year_id', $request->year_id)->first();

      if (empty($studentyear)) {
          $class = Classroom::findOrFail($request->classroom_id);

          // $sy = Studentyear::create([
          //       'student_id' => $student->id,
          //       'yeargradeclassroom_id' => $request->year_id . $class->grade_id . $request->classroom_id,
          //       'yearsemclassroom_id' => $request->year_id . 1 . $request->classroom_id,
          //       'year_id' => $request->year_id,
          //       'semester_id' => 1,
          //       'grade_id' => $class->grade_id,
          //       'classroom_id' => $request->classroom_id,
          //       'user_id' => Auth::user()->id,
          //       'created_by' => Auth::user()->name,
          //     ]);

          $sy = new Studentyear;
          $sy->student_id = $student->id;
          $sy->yeargradeclassroom_id = $request->year_id . $class->grade_id . $request->classroom_id;
          $sy->yearsemclassroom_id = $request->year_id . 1 . $request->classroom_id;
          $sy->year_id = $request->year_id;
          $sy->semester_id = 1;
          $sy->grade_id = $class->grade_id;
          $sy->classroom_id = $request->classroom_id;
          $sy->user_id = Auth::user()->id;
          $sy->created_by = Auth::user()->name;
          $sy->save();

          $sy = new Studentyear;
          $sy->student_id = $student->id;
          $sy->yeargradeclassroom_id = $request->year_id . $class->grade_id . $request->classroom_id;
          $sy->yearsemclassroom_id = $request->year_id . 2 . $request->classroom_id;
          $sy->year_id = $request->year_id;
          $sy->semester_id = 2;
          $sy->grade_id = $class->grade_id;
          $sy->classroom_id = $request->classroom_id;
          $sy->user_id = Auth::user()->id;
          $sy->created_by = Auth::user()->name;
          $sy->save();

          return response()->json(array(
                    'message' => 'Year successfully added.',
          ));
      } else {

          $year = Year::findOrFail($request->year_id);

          // $notification = array(
          //                         'message' => $year->yearname . ' already existed, choose different year.',
          //                         'alert-type' => 'error'
          //                       );
          //
          // echo json_encode($notification);

          return response()->json(array(
                    'message' => $year->yearname . ' already existed, choose different year.',
          ));

      }
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

          $genders = array('L' => 1, 'P' => 0);

        foreach($rows as $row) {
          $row = array_combine($header, $row);

          //For handle Duplication Entry Error
          try{
              //make array from input competency
              $arraysiblings = array_filter(array_map('trim',explode("#",$row['Siblings'])));

              $student = Student::where('noId', trim(preg_replace('/\s+/',' ', $row['No ID'])))->first();
              $arraydata = array();

              if(!empty($student)) {

                  $studentprofile = Studentprofile::where('student_id', $student->id)->first();
                  $studentprofile->gender = $genders[$row['Gender']];
                  $studentprofile->pob = $row['Place of Birth'];
                  $studentprofile->dob = $row['Date of Birth'];
                  $studentprofile->phone = $row['Phone Student'];
                  $studentprofile->email = $row['Email Student'];
                  $studentprofile->address = $row['Address Student'];
                  $studentprofile->citizenship = $row['Citizenship'];
                  $studentprofile->arraysibling = $arraysiblings;
                  $studentprofile->familystatus = $row['Family Status'];
                  $studentprofile->childno = $row['Child Number'];
                  $studentprofile->familiynote = $row['Family Note'];
                  $studentprofile->healthnote = $row['Health Note'];
                  $studentprofile->achievementnote = $row['Achievement Note'];
                  $studentprofile->prevschool = $row['Previous School'];
                  $studentprofile->prevschoolnote = $row['Previous School Note'];
                  $studentprofile->afterschoolnote = $row['After School Note'];
                  $studentprofile->schoolnote = $row['School Note'];
                  $studentprofile->father = $row['Father'];
                  $studentprofile->fatherphone = $row['Father Phone'];
                  $studentprofile->fatheremail = $row['Father Email'];
                  $studentprofile->mother = $row['Mother'];
                  $studentprofile->motheremail = $row['Mother Email'];
                  $studentprofile->motherphone = $row['Mother Phone'];
                  $studentprofile->guardian = $row['Guardian'];
                  $studentprofile->guardianphone = $row['Guardian Phone'];
                  $studentprofile->guardianemail = $row['Guardian Email'];
                  $studentprofile->parentaddress = $row['Parent Address'];
                  $studentprofile->parentnote = $row['Parent Note'];
                  $studentprofile->updated_by = ucfirst(Auth::user()->name);
                  $studentprofile->update();

              } else {
                $data = $row['No ID'] . ' ' . $row['Student'];
                $arraydata[] = $data;

                return $arraydata;
              }

             }catch(\Exception $exception) {

                $notification = array(
                  'message' => 'Database error! Duplication entry found. Error Code ' . $exception->getCode(),
                  'alert-type' => 'warning'
                );

                return redirect()->back()->with($notification);
            }
        }

        $notification = array(
          'message' => 'Student\'s profiles was successfully imported.',
          'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        }
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
          return view('academics.students.create');
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

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $studentprofile = Studentprofile::where('student_id', $student->id)->first();

        $hist = DB::table('studentyears')
                        ->join('students', 'students.id', '=', 'studentyears.student_id')
                        ->join('grades', 'grades.id', '=', 'studentyears.grade_id')
                        ->join('years', 'years.id', '=', 'studentyears.year_id')
                        ->join('semesters', 'semesters.id', '=', 'studentyears.semester_id')
                        ->leftJoin('classrooms', 'classrooms.id', '=', 'studentyears.classroom_id')
                        ->select('studentyears.id', 'studentyears.student_id', 'students.studentname', 'years.yearname', 'semesters.semestername', 'grades.gradename', 'classrooms.classroomname');

        $histories = $hist->where('student_id', $id)->get()->sortBy('id');

        //Check Student Profile if No Profile found, System create empty Profile
        if(!isset($student->studentprofile)) {
            $studentprofile = new Studentprofile;
            $studentprofile->student_id = $student->id;
            $studentprofile->user_id = Auth::user()->id;

            $studentprofile->save();

            return redirect()->route('students.edit', $student->id);
        }

        $years = Year::all();
        $classrooms = DB::table('classrooms')->where('classroomactive', 1)->get();

        return view('academics.students.edit', compact('student', 'studentprofile', 'hist', 'histories', 'years', 'classrooms'));
    }

    public function update(Request $request, $id)
    {
        //Validate Input
        $this->validate($request,[
          'noId' => 'required|unique:students,noId,'.$id,
          'studentname' => 'required',
          'student_img' => 'max:1900'
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
          $filename = 'student_avatar_' . $current_time = Carbon::now()->format('Y-m-d-H:i:s') . '.' . $avatar->getClientOriginalExtension();
          $location = public_path('images/students/' . $filename);
          Image::make($avatar)->fit(160)->save($location);

          $studentprofile->avatar = $filename;
        }
        //Get Month for Birthday
        if(isset($request->dob)) {
          $mm = date('m', strtotime($request->dob));
          $studentprofile->month_id = $mm;
        }

        $student->update($request->all()); $studentprofile->update($request->all());

        $notification = array(
          'message' => $student->studentname . ' was successfully updated.',
          'alert-type' => 'success'
        );

        return back()->with($notification);

    }

    public function destroy($id) {
        $studentyear = Studentyear::findOrFail($id);

        $studentyear->delete();

        $notification = array(
          'message' => 'Year Academic was successfully deleted.',
          'alert-type' => 'error'
        );

        return back()->with($notification);
    }
}
