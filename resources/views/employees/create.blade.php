@extends('layouts.dashboard')

@section('title', 'New Employee')

@section('part_stylesheet')

@endsection

@section('stylesheets')
  <!-- fullcalendar -->
  <link rel="stylesheet" href="/src/fullcalendar/dist/fullcalendar.min.css">
  <!-- Datetimepicker -->
  <link rel="stylesheet" href="/src/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css"/>
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('src/select2/dist/css/select2.min.css') }}">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('employees.index') }}">Employees</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('employees.index') }}" class="btn btn-xs btn-default">Back</a>
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
    <div class="box-header" style="margin-left: 16px; margin-bottom: -16px;">
      <h3 class="box-title">@yield('button')</h3>
    </div>
    <hr>
    <!-- /.box-header -->
    <div class="box-body" style="margin-left: 15px; margin-right: 15px;">
      <form enctype="multipart/form-data" role="form" action="{{ route('employees.store') }}" method="POST">
        {{ csrf_field() }}
      @include('employees._form_create')
        <div class="box-footer" style="margin-top: 15px;">
            <!-- Submit Form Button -->
            {!! Form::submit('Save', ['class' => 'btn btn-xs btn-success']) !!}
            <!-- Back Button -->
            <a href="{{ route('employees.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
</div>
@endsection

@section('scripts')
  <!-- Datetimepicker -->
  <script type="text/javascript" src="{{ asset('src/moment/min/moment.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('src/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') }}"></script>
  <!-- toastr notifications -->
  <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>
  <!-- fullcalendar -->
  <script type="text/javascript" src="/src/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="{{ asset('src/select2/dist/js/select2.min.js') }}"></script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();
    });
    /* Datetimepicker*/
    $(function dateTimePicker() {
      $('#datetimepicker1').datetimepicker({
          sideBySide: true
      });
    });
  </script>
@endsection
