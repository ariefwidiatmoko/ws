<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Subject;
use App\Lesson;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Image;
use Session;
use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
     use Authorizable;

     public function index(Request $request, Lesson $lesson)
     {

         $lessons = Lesson::query();

         if (isset($request->search)) {
               $lessons->where('lessontitle', 'like', "%{$request->search}%")->orWhere('lessoncontent', 'like', "%{$request->search}%");
         }

         if (isset($request->subject_id)) {
             $lessons->where('subject_id', $request->subject_id);
         }

         if (isset($request->user_id)) {
               $lessons->where('user_id', $request->user_id);
         }

         if (isset($request->lessonactive)) {
               $lessons->where('lessonactive', $request->lessonactive);
         }

         $result = $lessons->orderBy('created_at', 'desc')->paginate(20);

         $pagination = (isset($request->subject_id)) ? $result->appends(['subject_id' => $request->subject_id]) : '';
         $pagination = (isset($request->user_id)) ? $result->appends(['user_id' => $request->user_id]) : '';
         $pagination = (isset($request->lessonactive)) ? $result->appends(['lessonactive' => $request->lessonactive]) : '';
         $pagination = (isset($request->search)) ? $result->appends(['lessontitle' => $request->search]) : '';

         $subjects = Subject::where('subjectactive', 1)->orderBy('subjectname')->get();
         $users = User::all();

         $request->flash();

         $total_result = $result->total();

         return view('contents.lessons.index', compact('lessons', 'result', '$pagination', 'subjects', 'users', 'total_result', 'request'));

    }

    public function publish()
    {
        $id = Input::get('id');

        $lesson = Lesson::findOrFail($id);

        $lesson->lessonactive = !$lesson->lessonactive;
        $lesson->save();

        return response()->json($lesson);
    }

    public function create()
    {
        $subjects = Subject::where('subjectactive', 1)->orderBy('subjectname')->get();

        return view('contents.lessons.create', compact('subjects'));
    }

    public function store(Request $request) {

        // Validate the data
        $this->validate($request, array(
          'subject_id' => 'required',
          'lessontitle' => 'required|string|max:200',
          'lessoncontent' => 'required'
        ));

        $lesson = new Lesson;

        $lesson->user_id = Auth::user()->id;
        $lesson->subject_id = $request->subject_id;
        $lesson->lessontitle = $request->lessontitle;
        $lesson->lessoncontent = $request->lessoncontent;
        $lesson->lessonactive = $request->lessonactive;

        $lesson->save();

        $notification = array(
          'message' => ucwords($request->lessontitle) . ' was successfully saved.',
          'alert-type' => 'success'
        );

      return redirect()->route('lessons.show', $lesson->id)->with($notification);
    }

    public function show($id)
    {
      $lesson = Lesson::findOrFail($id);

      return view('contents.lessons.show', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        $lesson = Lesson::findOrFail($lesson->id);
        $subjects = Subject::where('subjectactive', 1)->orderBy('subjectname')->get();

        return view('contents.lessons.edit', compact('lesson', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $me = $request->user();

        if( $me->hasRole('Admin') ) {
            $lesson = Lesson::findOrFail($id);
        } else {
            $lesson = $me->lessons()->findOrFail($id);
        }

        // Validate the data
        $this->validate($request, array(
          'subject_id' => 'required',
          'lessontitle' => 'required|string|max:200',
          'lessoncontent' => 'required'
        ));

        if( !isset($request->lessonactive)) {
          $lesson->update(array_merge($request->all(), ['lessonactive' => false] ));
        } else {
          $lesson->update($request->all());

          $notification = array(
            'message' => ucwords($request->lessontitle) . ' was successfully updated.',
            'alert-type' => 'success'
          );

        return redirect()->route('lessons.show', $lesson->id)->with($notification);
        }
    }

    public function destroy(Lesson $lesson)
    {
        $me = Auth::user();

        if( $me->hasRole('Admin') ) {
            $lesson = Lesson::findOrFail($lesson->id);
        } else {
            $lesson = $me->lessons()->findOrFail($lesson->id);
        }

        $lesson->delete();

        $notification = array(
          'message' => ucwords($lesson->lessontitle) . ' was successfully deleted.',
          'alert-type' => 'error'
        );

        return redirect()->route('lessons.index')->with($notification);
    }
}
