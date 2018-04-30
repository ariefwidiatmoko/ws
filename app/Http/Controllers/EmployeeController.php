<?php

namespace App\Http\Controllers;

use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Employee;
use App\Position;
use App\User;
use Carbon\Carbon;
use Image;
use Session;
use File;
use Illuminate\Support\Facades\Input;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
      $query = $request->get('search');

      if ($query == 'yes') {
          $result = Employee::where('statusActive', 1)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
      }
     elseif ($query == 'no') {
          $result = Employee::where('statusActive', 0)
                       ->orderBy('created_at', 'desc')
                       ->paginate(20);
     }
     else {
          $result = Employee::where('fullname','like','%'.$query.'%')
                      ->orderBy('statusActive', 'desc')
                      ->orderBy('fullname')
                      ->paginate(20);

      }

      return view('employees.index', compact('result', 'query'));
    }

    public function statusActive()
    {
        $id = Input::get('id');

        $employee = Employee::findOrFail($id);

        $employee->statusActive = !$employee->statusActive;
        $employee->save();

        return response()->json($employee);
    }

    public function create()
    {
        $nowDate = Carbon::now()->toDateString();
        $positions = Position::all();

        return view('employees.create', compact('positions', 'nowDate'));
    }

    public function store(Request $request)
    {

        // Validate the data
        $this->validate($request, array(
          'noId' => 'required|unique:employees',
          'fullname' => 'required',
        ));

        $employee = new Employee;

        $employee->user_id =  Auth::user()->id;
        $employee->noId = $request->noId;
        $employee->fullname = $request->fullname;
        $employee->dob = $request->dob;
        $employee->month_id = $request->dob->format('m');
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->quote = $request->quote;
        $employee->about = $request->about;
        $employee->statusActive = $request->statusActive;

        //save Image Avatar

        //save new image
        $avatar = $request->file('employee_img');
        $filename = 'employee_avatar_' . $current_time = Carbon::now()->toDateTimeString() . '.' . $avatar->getClientOriginalExtension();
        $location = public_path('images/employees/' . $filename);
        Image::make($avatar)->fit(160)->save($location);

        $employee->avatar = $filename;

        $employee->save();

        $employee->positions()->sync($request->positions);

        flash()->success('Employee was successfully saved.');

        return redirect()->route('employees.edit', $employee->id);


    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        $positions = Position::all();

        return view('employees.edit', compact('employee', 'positions'));
    }

    public function update(Request $request, $id)
    {
      $me = $request->user();

      $positions = Position::all();

      if( $me->hasRole('Admin') ) {
          $employee = Employee::findOrFail($id);
      } else {
          $employee = $me->employees()->findOrFail($id);
      }

      // Validate the data
      $this->validate($request, array(
        'noId' => 'required|unique:employees,name,'.$employee->id,
        'fullname' => 'required',
      ));

      //delete old images
      if (Input::hasFile('employee_img')) {

          //delete old image
          $oldImage = public_path("images/employees/{$employee->avatar}"); // get previous image from folder
          if (File::exists($oldImage)) {
            File::delete($oldImage);
          }

          //save new image
          $avatar = $request->file('employee_img');
          $filename = 'employee_avatar_' . $current_time = Carbon::now()->toDateTimeString() . '.' . $avatar->getClientOriginalExtension();
          $location = public_path('images/employees/' . $filename);
          Image::make($avatar)->fit(160)->save($location);

          $employee->avatar = $filename;
      }

      if(isset($request->dob)) {
          $employee->month_id = $request->dob->format('m');
      }

      if( !isset($request->statusActive))
          $employee->update(array_merge($request->all(), ['statusActive' => false] ));
              else
          $employee->update($request->all());

      $employee->positions()->sync($request->positions);

      flash()->success('Employee has been updated.');

      return redirect()->route('employees.edit', $employee->id);
    }

    public function destroy($id)
    {
        //
    }
}
