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
               $lessons->where('title', 'like', "%{$request->search}%")->orWhere('content', 'like', "%{$request->search}%");
         }

         if (isset($request->subject_id)) {
             $lessons->where('subject_id', $request->subject_id);
         }

         if (isset($request->user_id)) {
               $lessons->where('user_id', $request->user_id);
         }

         if (isset($request->live)) {
               $lessons->where('live', $request->live);
         }

         $result = $lessons->orderBy('updated_at', 'desc')->orderBy('published_at', 'desc')->paginate(20);

         $pagination = (isset($request->subject_id)) ? $result->appends(['subject_id' => $request->subject_id]) : '';
         $pagination = (isset($request->user_id)) ? $result->appends(['user_id' => $request->user_id]) : '';
         $pagination = (isset($request->live)) ? $result->appends(['live' => $request->live]) : '';
         $pagination = (isset($request->search)) ? $result->appends(['title' => $request->search]) : '';

         $subjects = Subject::where('live', 1)->orderBy('name')->get();
         $users = User::all();

         $request->flash();

         $total_result = $result->total();

         return view('lessons.index', compact('lessons', 'result', '$pagination', 'subjects', 'users', 'total_result', 'request'));

    }

    public function publish()
    {
        $id = Input::get('id');

        $lesson = Lesson::findOrFail($id);

        $lesson->live = !$lesson->live;
        $lesson->save();

        return response()->json($lesson);
    }

    public function create()
    {
        $subjects = Subject::where('live', 1)->orderBy('name')->get();

        return view('lessons.create', compact('subjects'));
    }

    public function store(Request $request) {

        // Validate the data
        $this->validate($request, array(
          'subject_id' => 'required',
          'title' => 'required|string|max:200',
          'content' => 'required'
        ));

        $lesson = new Lesson;

        $lesson->user_id = Auth::user()->id;
        $lesson->subject_id = $request->subject_id;
        $lesson->title = $request->title;
        $lesson->content = $request->content;
        $lesson->live = $request->live;

        $lesson->save();

        flash()->success('Lesson was successfully saved.');

      return redirect()->route('lessons.show', $lesson->id);
    }

    public function show($id)
    {
      $lesson = Lesson::findOrFail($id);

      return view('lessons.show', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        $lesson = Lesson::findOrFail($lesson->id);
        $subjects = Subject::where('live', 1)->orderBy('name')->get();

        return view('lessons.edit', compact('lesson', 'subjects'));
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
          'title' => 'required|string|max:200',
          'content' => 'required'
        ));

        if( !isset($request->live)) {
          $lesson->update(array_merge($request->all(), ['live' => false] ));
        } else {
          $lesson->update($request->all());
        }

        flash()->success('Lesson has been updated.');

        return redirect()->route('lessons.show', $lesson->id);
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

        flash()->success('Lesson has been deleted.');

        return redirect()->route('lessons.index');
    }
}