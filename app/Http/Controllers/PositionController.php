<?php

namespace App\Http\Controllers;

use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Position;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Session;


class PositionController extends Controller
{
    use Authorizable;

    public function index(Request $request)
    {
      $query = $request->get('search');

      if ($query == 'yes') {
          $result = Position::where('positionactive', 1)
                        ->orderBy('positionname')
                        ->paginate(20);
      }
     elseif ($query == 'no') {
          $result = Position::where('positionactive', 0)
                       ->orderBy('positionname')
                       ->paginate(20);
     }
     else {
          $result = Position::where('positionname','like','%'.$query.'%')
                      ->orWhere('positionactive','like','%'.$query.'%')
                      ->orderBy('positionname')
                      ->paginate(20);
      };

      return view('academics.positions.index', compact('result', 'query'));
    }

    public function publish()
    {
        $id = Input::get('id');

        $position = Position::findOrFail($id);

        $position->positionactive = !$position->positionactive;
        $position->save();

        return response()->json($position);
    }

    public function create()
    {
        return view('academics.positions.create');
    }

    public function store(Request $request)
    {
      // Validate the data
      $this->validate($request, array(
        'positionname' => 'required|unique:positions'
      ));

      $position = new Position;

      $position->user_id = Auth::user()->id;
      $position->positionname = $request->positionname;
      $position->positionactive = $request->positionactive;

      $position->save();

      $notification = array(
        'message' => ucwords($request->positionname) . ' was successfully saved.',
        'alert-type' => 'success'
      );

      return redirect()->route('positions.index')->with($notification);
    }

    public function show($id)
    {
        $position = Position::findOrFail($id);

        return view('academics.positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        $position = Position::findOrFail($position->id);

        return view('academics.positions.edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
      $me = $request->user();

      if( $me->hasRole('Admin') ) {
          $position = Position::findOrFail($id);
      } else {
          $position = $me->positions()->findOrFail($id);
      }

      // Validate the data
      $this->validate($request, array(
        'positionname' => 'required|unique:positions,positionname,'.$position->id
      ));

      if( !isset($request->positionactive))
          $position->update(array_merge($request->all(), ['positionactive' => false] ));
              else
          $position->update($request->all());

          $notification = array(
            'message' => ucwords($request->positionname) . ' was successfully updated.',
            'alert-type' => 'success'
          );

      return redirect()->route('positions.index')->with($notification);
    }

    public function destroy(Position $position)
    {
      $me = Auth::user();

      if( $me->hasRole('Admin') ) {
          $position = Position::findOrFail($position->id);
      } else {
          $position = $me->positions()->findOrFail($position->id);
      }

      $position->delete();

      $notification = array(
        'message' => ucwords($position->positionname) . ' was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('positions.index')->with($notification);
    }
}
