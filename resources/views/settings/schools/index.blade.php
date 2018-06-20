@extends('layouts.dashboard')

@section('title', 'School Profile')

@section('stylesheets')
  <!-- fullcalendar -->
  <link rel="stylesheet" href="/src/fullcalendar/dist/fullcalendar.min.css">
  <!-- Datetimepicker -->
  <link rel="stylesheet" href="/src/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css" />
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
  <style media="screen">
    tr>td:hover {
                  color: #458dd5;
                }
  </style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')
  <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-xs btn-success">Edit School Profile</a>
@endsection

@section('content')
<div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
<div class="box box-primary collapsed-box" style="margin-top: 20px;">
  <div class="box-header">
    <div class="col-md-6">
      @yield('navmenu')
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
</div>
  <div class="box" style="margin-top: -20px;">
    <div class="box-header" style="margin-left: 16px;">
      <h3 class="box-title">@yield('button')</h3>
    </div>
    <!-- /.box-header -->
    <div id="inlist" class="table-responsive box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="inlist" class="table table-hover" style="margin-left: 15px;">
            <thead>
              <tr>
                  <th style="width: 10%;">Detail School Profile</th>
                  <th style="width: 15%;">Description</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>School Name</td>
                  <td>{{$school->schoolname ? $school->schoolname : ''}}</td>
                </tr>
                <tr>
                  <td>Principal</td>
                  <td>{{$school->principal ? $school->principal : ''}}</td>
                </tr>
                <tr>
                  <td>Vice Principal</td>
                  <td>{{$school->viceprincipal ? $school->viceprincipal : ''}}</td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td>{{$school->address ? $school->address : ''}}</td>
                </tr>
                <tr>
                  <td>Phone</td>
                  <td>{{$school->phone ? $school->phone : ''}}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>{{$school->email ? $school->email : ''}}</td>
                </tr>
                <tr>
                  <td><b>Academics Settings</b> @if(isset($yearactive->year_id)) <a href="{{route('schools.editYear', $yearactive->id)}}"><button class="btn btn-xs btn-default">Edit</button></a> @endif</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Year Active</td>
                  <td>{{$yearactive->year_id ? $yearactive->year->yearname : ''}}</td>
                </tr>
                <tr>
                  <td>Semester Active</td>
                  <td>{{$yearactive->semester_id ? $yearactive->semester->semestername : ''}}</td>
                </tr>
                <tr>
                  <td>Print Report's Date</td>
                  <td>{{$school->printdate ? $school->printdate : ''}}</td>
                </tr>
                <tr>
                  <td style="text-align: center;">Created by : {{$school->created_by ? ucwords($school->created_by) : ''}}</td>
                  <td></td>
                </tr>
                <tr>
                  <td style="text-align: center;">Updated by : {{$school->updatedby_id ? ucwords($school->updated_by) : ucwords($school->created_by)}}</td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <!-- toastr notifications -->
    <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>
@endsection
