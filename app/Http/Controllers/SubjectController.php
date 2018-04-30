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

        $result = Subject::where('name','like','%'.$query.'%')
                      ->orWhere('alias', 'like', '%'.$query.'%')
                      ->orderBy('name')
                      ->paginate(20);
        return view('subjects.index', compact('result', 'query'));
    }

    public function publish()
    {
        $id = Input::get('id');

        $subject = Subject::findOrFail($id);

        $subject->live = !$subject->live;
        $subject->save();

        return response()->json($subject);
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request) {

      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:subjects',
        'alias' => 'required'
      ));

      $subject = new Subject;

      $subject->user_id = Auth::user()->id;
      $subject->name = $request->name;
      $subject->alias = $request->alias;
      $subject->live = $request->live;

      $subject->save();

      flash()->success('Subject was successfully saved.');

      return redirect()->route('subjects.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Subject $subject)
    {
      $subject = Subject::findOrFail($subject->id);

      return view('subjects.edit', compact('subject'));
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

      if( !isset($request->live))
          $subject->update(array_merge($request->all(), ['live' => false] ));
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