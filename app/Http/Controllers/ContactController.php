<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

      if (isset($request->month_id)) {
          $students->whereHas('studentprofile', function($q) use ($request) {
            $q->where('month_id', $request->month_id);
          });
      }

      if (isset($request->user_id)) {
          $students->where('user_id', $request->user_id);
      }

      if (isset($request->statusActive)) {
          $students->where('statusActive', $request->statusActive);
      }

      if (isset($request->search)) {
          $students->where('studentname', 'like',  "%{$request->search}%")->orWhere('studentnick', 'like'. "%{$request->search}%")->orWhereHas('studentprofile', function ($q) use ($request) {
            $q->where('email', 'like', "%{$request->search}%")->orWhere('address', 'like', "%{$request->search}%");
          });
      }

      $result = $students->orderBy('updated_at', 'desc')->paginate(20);

      $pagination = (isset($request->month_id)) ? $result->appends(['month_id' => $request->month_id]) : '';
      $pagination = (isset($request->user_id)) ? $result->appends(['user_id' => $request->user_id]) : '';
      $pagination = (isset($request->active)) ? $result->appends(['studentactive' => $request->active]) : '';
      $pagination = (isset($request->search)) ? $result->appends(['email' => $request->search, 'address' => $request->search]) : '';

      $users = User::all();
      $months = Month::all();

      $request->flash();

      return view('contacts.indexStudent', compact('result', 'students', 'query', 'months', 'users', '$pagination', 'request'));
    }

    public function indexEmployee(Request $request)
    {
      $employees = Employee::query();

      if (isset($request->month_id)) {
          $employees->where('month_id', $request->month_id);
      }

      if (isset($request->user_id)) {
          $employees->where('user_id', $request->user_id);
      }

      if (isset($request->search)) {
          $employees->where('employeename', 'like',  "%{$request->search}%")->orWhere('phone', 'like'. "%{$request->search}%")->orWhere('address', 'like', "%{$request->search}%")->orWhere('education', 'like', "%{$request->search}%");
      }

      if (isset($request->statusActive)) {
          $employees->where('employeeactive', $request->statusActive);
      }

      $result = $employees->orderBy('updated_at', 'desc')->paginate(20);

      $pagination = (isset($request->month_id)) ? $result->appends(['month_id' => $request->month_id]) : '';
      $pagination = (isset($request->user_id)) ? $result->appends(['user_id' => $request->user_id]) : '';
      $pagination = (isset($request->statusActive)) ? $result->appends(['employeeactive' => $request->statusActive]) : '';
      $pagination = (isset($request->search)) ? $result->appends(['employeename' => $request->search, 'address' => $request->search]) : '';

      $users = User::all();
      $months = Month::all();

      $request->flash();

      return view('contacts.indexEmployee', compact('result', 'query', 'employee', 'months', 'users', 'pagination', 'request'));
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
