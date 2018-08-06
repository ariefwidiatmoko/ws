<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competencyalpha;

class CompetencyalphaController extends Controller
{

    public function index()
    {
        $result = Competencyalpha::paginate(100);

        return view('settings.competencyalphas.index', compact('result'));
    }

    public function store(Request $request)
    {
        $competencyalpha = new Competencyalpha;
        $competencyalpha->score = array(0 => $request->score1, 1 => $request->score2);
        $competencyalpha->alphabet = $request->alphabet;
        $competencyalpha->description = $request->description;
        $competencyalpha->save();

        $notification = array(
          'message' => ucwords($request->alphabet) . ' was successfully saved.',
          'alert-type' => 'success'
        );

        return redirect()->route('competencyalphas.index')->with($notification);

    }

    public function update(Request $request, $id)
    {
        $competencyalpha = Competencyalpha::findOrFail($id);

        $competencyalpha->score = array(0 => $request->score1, 1 => $request->score2);
        $competencyalpha->alphabet = $request->alphabet;
        $competencyalpha->description = $request->description;
        $competencyalpha->update();

        return response()->json($competencyalpha);
    }

    public function destroy($id)
    {
      $competencyalpha = Competencyalpha::findOrFail($id);

      $competencyalpha->delete();

      $notification = array(
        'message' => ucwords($competencyalpha->alphabet) . ' was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('competencyalphas.index')->with($notification);
    }
}
