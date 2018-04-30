<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Student;

class ImportController extends Controller
{
    public function importcsv() {
      return view('importstudent');
    }

    public function csvStudent(Request $request) {
      $validator = Validator::make($request->all(), [
        'file' => 'required',
      ]);

      if($validator->fails()) {
        return redirect()->back()->withErrors($validator);
      }

      $file = $request->file('file');
      $csvData = file_get_contents($file);
      $rows = array_map('str_getcsv', explode("\n", $csvData));
      $filtered = array_pop($rows);
      $header = array_shift($rows);

      foreach($rows as $row) {
        $row = array_combine($header, $row);

        Student::create([
          'noId' => $row['noId'],
          'noIdNational' => $row['noIdNational'],
          'fullname' => $row['fullname'],
          'nickName' => $row['nickName'],
          'statusActive' => 1,
          'user_id' => Auth::user()->id,
        ]);
      }

      flash()->success('CSV was successfully saved.');

      return redirect()->back();

    }
}
