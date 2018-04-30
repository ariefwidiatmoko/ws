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


class PositionController extends Controller
{
    use Authorizable;

    public function index(Request $request)
    {
      $query = $request->get('search');

      if ($query == 'yes') {
          $result = Position::where('live', 1)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
      }
     elseif ($query == 'no') {
          $result = Position::where('live', 0)
                       ->orderBy('created_at', 'desc')
                       ->paginate(20);
     }
     else {
          $result = Position::where('name','like','%'.$query.'%')
                      ->orWhere('live','like','%'.$query.'%')
                      ->orderBy('name')
                      ->paginate(20);
      };

      return view('positions.index', compact('result', 'query'));
    }

    public function publish()
    {
        $id = Input::get('id');

        $position = Position::findOrFail($id);

        $position->live = !$position->live;
        $position->save();

        return response()->json($position);
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
      // Validate the data
      $this->validate($request, array(
        'name' => 'required|unique:positions'
      ));

      $position = new Position;

      $position->user_id = Auth::user()->id;
      $position->name = $request->name;
      $position->live = $request->live;

      $position->save();

      flash()->success('Position was successfully saved.');

      return redirect()->route('positions.index');
    }

    public function show($id)
    {
        $position = Position::findOrFail($id);

        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
      $position = Position::findOrFail($position->id);

      return view('positions.edit', compact('position'));
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
        'name' => 'required|unique:positions,name,'.$position->id
      ));

      if( !isset($request->live))
          $position->update(array_merge($request->all(), ['live' => false] ));
              else
          $position->update($request->all());

      flash()->success('Position has been updated.');

      return redirect()->route('positions.index');
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

      flash()->success('Position has been deleted.');

      return redirect()->route('positions.index');
    }
}
