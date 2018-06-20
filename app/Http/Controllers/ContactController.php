<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Month;
use App\Employee;
use App\Student;
use App\Studentprofile;

class ContactController extends Controller
{

    public function indexStudent(Request $request)
    {
            $students = Student::query();

            if (isset($request->search)) {
                $students->where('studentname', 'like',  "%{$request->search}%")->orWhere('studentnick', 'like'. "%{$request->search}%")->orWhereHas('studentprofile', function ($q) use ($request) {
                  $q->where('email', 'like', "%{$request->search}%")->orWhere('address', 'like', "%{$request->search}%");
                });
            }

            if (isset($request->month_id)) {
                $students->whereHas('studentprofile', function($q) use ($request) {
                  $q->where('month_id', $request->month_id);
                });
            }

            if (isset($request->user_id)) {
                $students->where('user_id', $request->user_id);
            }

            if (isset($request->studentactive)) {
                $students->where('studentactive', $request->studentactive);
            }

            if (isset($request->studentname)) {
                $students->where('studentname', 'like',  "%{$request->studentname}%");
            }

            $result = $students->orderBy('studentname')->paginate(20);

            $pagination = (isset($request->month_id)) ? $result->appends(['month_id' => $request->month_id]) : '';
            $pagination = (isset($request->user_id)) ? $result->appends(['user_id' => $request->user_id]) : '';
            $pagination = (isset($request->studentactive)) ? $result->appends(['studentactive' => $request->studentactive]) : '';
            $pagination = (isset($request->search)) ? $result->appends(['studentname' => $request->search, 'email' => $request->search, 'address' => $request->search]) : '';

            $users = User::all();
            $months = Month::all();

            $request->flash();

            return view('contacts.indexStudent', compact('result', 'students', 'query', 'months', 'users', '$pagination', 'request'));
    }

    public function indexEmployee(Request $request)
    {
      $employees = Employee::query();

      if (isset($request->search)) {
          $employees->where('employeename', 'like',  "%{$request->search}%")->orWhere('phone', 'like'. "%{$request->search}%")->orWhere('address', 'like', "%{$request->search}%")->orWhere('education', 'like', "%{$request->search}%");
      }

      if (isset($request->month_id)) {
          $employees->where('month_id', $request->month_id);
      }

      if (isset($request->user_id)) {
          $employees->where('user_id', $request->user_id);
      }

      if (isset($request->employeeactive)) {
          $employees->where('employeeactive', $request->employeeactive);
      }

      if (isset($request->employeename)) {
          $students->where('employeename', 'like',  "%{$request->employeename}%");
      }

      $result = $employees->orderBy('employeename')->paginate(20);

      $pagination = (isset($request->month_id)) ? $result->appends(['month_id' => $request->month_id]) : '';
      $pagination = (isset($request->user_id)) ? $result->appends(['user_id' => $request->user_id]) : '';
      $pagination = (isset($request->statusActive)) ? $result->appends(['employeeactive' => $request->employeeactive]) : '';
      $pagination = (isset($request->search)) ? $result->appends(['employeename' => $request->search, 'address' => $request->search]) : '';

      $users = User::all();
      $months = Month::all();

      $monthnow = Carbon::now()->format('m');

      $birthmonth = Employee::where('month_id', $monthnow)->get();

      $request->flash();

      return view('contacts.indexEmployee', compact('result', 'query', 'employee', 'months', 'users', 'pagination', 'request', 'birthmonth'));
    }

    public function indexUser(Request $request)
    {
      $users = User::query();

      if (isset($request->search)) {
          $employees->where('name', 'like',  "%{$request->search}%")->orWhere('email', 'like'. "%{$request->search}%");
      }

      $result = $users->orderBy('name')->paginate(20);

      $pagination = (isset($request->search)) ? $result->appends(['name' => $request->search]) : '';

      $request->flash();

      return view('contacts.indexUser', compact('result', 'query', 'users', 'pagination', 'request'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
