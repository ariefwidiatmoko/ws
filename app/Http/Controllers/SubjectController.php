<?php

namespace App\Http\Controllers;

use App\Authorizable;
use Illuminate\Http\Request;
use App\Subject;
use App\User;
use App\Lesson;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('search');

        $result = Subject::where('subjectname','like','%'.$query.'%')
                      ->orWhere('alias', 'like', '%'.$query.'%')
                      ->orderBy('subjectname')
                      ->paginate(20);
        return view('settings.subjects.index', compact('result', 'query'));
    }

    public function publish()
    {
        $id = Input::get('id');

        $subject = Subject::findOrFail($id);

        $subject->subjectactive = !$subject->subjectactive;
        $subject->save();

        return response()->json($subject);
    }

    public function create()
    {
        return view('settings.subjects.create');
    }

    public function store(Request $request) {

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:subjects',
        'alias' => 'required'
      ));

      $subject = new Subject;

      $subject->user_id = Auth::user()->id;
      $subject->subjectname = $request->name;
      $subject->alias = $request->alias;
      $subject->subjectactive = $request->active;

      $subject->save();

      flash()->success('Subject was successfully saved.');

      return redirect()->route('subjects.index');
    }

    public function edit(Subject $subject)
    {
      $subject = Subject::findOrFail($subject->id);

      return view('settings.subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id) {
      $me = $request->user();

      if( $me->hasRole('Admin') ) {
          $subject = Subject::findOrFail($id);
      } else {
          $subject = $me->subjects()->findOrFail($id);
      }

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:subjects,name,'.$subject->id,
        'alias' => 'required'
      ));

      if( !isset($request->active))
          $subject->update(array_merge($request->all(), ['subjectactive' => false] ));
              else
          $subject->update($request->all());

      flash()->success('Subject has been updated.');

      return redirect()->route('subjects.index');
    }

    public function destroy(Subject $subject)
    {
      $me = Auth::user();

      if( $me->hasRole('Admin') ) {
          $subject = Subject::findOrFail($subject->id);
      } else {
          $subject = $me->subjects()->findOrFail($subject->id);
      }

      $subject->delete();

      flash()->success('Subject has been deleted.');

      return redirect()->route('subjects.index');
    }
}
