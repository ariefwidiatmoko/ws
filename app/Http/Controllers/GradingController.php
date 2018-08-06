<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grading;

class GradingController extends Controller
{
  public function index()
  {
      $result = Grading::paginate(100);

      return view('settings.gradings.index', compact('result'));
  }

  public function store(Request $request)
  {
      $grading = new Grading;
      $grading->score = array(0 => $request->score1, 1 => $request->score2);
      $grading->alphabet = $request->alphabet;
      $grading->description = $request->description;
      $grading->save();

      $notification = array(
        'message' => ucwords($request->alphabet) . ' was successfully saved.',
        'alert-type' => 'success'
      );

      return redirect()->route('gradings.index')->with($notification);

  }

  public function update(Request $request, $id)
  {
      $grading = Grading::findOrFail($id);
      $grading->score = array(0 => $request->score1, 1 => $request->score2);
      $grading->alphabet = $request->alphabet;
      $grading->description = $request->description;
      $grading->update();

      return response()->json($grading);
  }

  public function destroy($id)
  {
    $grading = Grading::findOrFail($id);

    $grading->delete();

    $notification = array(
      'message' => ucwords($grading->alphabet) . ' was successfully deleted.',
      'alert-type' => 'error'
    );

    return redirect()->route('gradings.index')->with($notification);
  }
}
