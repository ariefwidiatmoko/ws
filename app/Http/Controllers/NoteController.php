<?php

namespace App\Http\Controllers;

use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Note;
use App\User;
use Carbon\Carbon;
use Image;
use Session;
use File;
use Illuminate\Support\Facades\Input;

class NoteController extends Controller
{
    use Authorizable;

     public function index(Request $request, Note $note)
     {
         $notes = Note::query();
         $users = User::all();

         $segments = array('Announcement', 'News', 'Event', 'Final Exam', 'Holiday');

         if (isset($request->search)) {
             $notes->where('notename', 'like', "%{$request->search}%")->orWhere('description', 'like', "%{$request->search}%");
         }

         if (isset($request->name)) {
               $notes->where('notename', $request->name);
         }

         if (isset($request->user_id)) {
               $notes->where('user_id', $request->user_id);
         }

         if (isset($request->active)) {
               $notes->where('noteactive', $request->active);
         }

        $result = $notes->orderBy('updated_at', 'desc')->paginate(20);

        $pagination = (isset($request->user_id)) ? $result->appends(['user_id' => $request->user_id]) : '';
        $pagination = (isset($request->active)) ? $result->appends(['noteactive' => $request->active]) : '';
        $pagination = (isset($request->search)) ? $result->appends(['notename' => $request->search]) : '';

        $request->flash();

        $total_result = $result->total();

        return view('contents.notes.index', compact('result', 'query', 'users', '$pagination', 'users', 'total_result', 'request', 'segments'));
    }

    public function publish()
    {
        $id = Input::get('id');

        $note = Note::findOrFail($id);

        $note->noteactive = !$note->noteactive;
        $note->save();

        return response()->json($note);
    }

    public function create()
    {
        return view('contents.notes.create');
    }

    public function store(Request $request) {

        // Validate the data
        $this->validate($request, array(
          'name' => 'required',
          'title' => 'required|string|max:200',
          'description' => 'required'
        ));

        $note = new Note;

        $note->user_id = Auth::user()->id;
        $segment = array('Announcement', 'News', 'Event', 'Final Exam', 'Holiday');
        $note->notesegment = $segment[$request->name];
        $note->notetitle = $request->title;
        $note->description = $request->description;
        $note->noteactive = $request->active;

        //save Image Avatar
        if (Input::hasFile('note_image')) {

            //delete old image
            $oldImage = public_path("images/notes/{$note->image}"); // get previous image from folder
            if (File::exists($oldImage)) {
            File::delete($oldImage);
            }
            //save new image
            $image = $request->file('note_image');
            $filename = 'note_image_' . $current_time = Carbon::now()->toDateTimeString() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/notes/' . $filename);
            Image::make($image)->save($location);

            $note->image = $filename;
        }

        $note->save();

        flash()->success('Note was successfully saved.');

      return redirect()->route('notes.show', $note->id);
    }

    public function show($id)
    {
      $note = Note::findOrFail($id);

      return view('contents.notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $note = Note::findOrFail($note->id);

        $segment = array('Announcement', 'News', 'Event', 'Final', 'Holiday');

        return view('contents.notes.edit', compact('note', 'segment'));
    }

    public function update(Request $request, $id)
    {
        $me = $request->user();

        if( $me->hasRole('Admin') ) {
            $note = Note::findOrFail($id);
        } else {
            $note = $me->notes()->findOrFail($id);
        }

        // Validate the data
        $this->validate($request, array(
          'name' => 'required|unique:subjects,name,'.$subject->id,
          'title' => 'required',
          'description' => 'required'
        ));

        //save Image Avatar
        if (Input::hasFile('note_image')) {
            //delete old image
            $oldImage = public_path("images/notes/{$note->image}"); // get previous image from folder
            if (File::exists($oldImage)) {
            File::delete($oldImage);
            }
            //save new image
            $image = $request->file('note_image');
            $filename = 'note_image_' . $current_time = Carbon::now()->toDateTimeString() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/notes/' . $filename);
            Image::make($image)->save($location);

            $note->image = $filename;
        }

        if( !isset($request->active))
            $note->update(array_merge($request->all(), ['noteactive' => false] ));
                else
            $note->update($request->all());

        flash()->success('Note has been updated.');

        return redirect()->route('notes.show', $note->id);
    }

    public function destroy(Note $note)
    {
        $me = Auth::user();

        if( $me->hasRole('Admin') ) {
            $note = Note::findOrFail($note->id);
        } else {
            $note = $me->notes()->findOrFail($note->id);
        }

        $note->delete();

        flash()->success('Note has been deleted.');

        return redirect()->route('notes.index');
    }
}
