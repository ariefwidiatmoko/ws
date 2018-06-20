@extends('layouts.dashboard')

@section('title', 'Edit Employee')

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
  <a href="{{ route('employees.index') }}" class="btn btn-xs btn-default"></i> Back</a>
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
  <div class="row" style="margin-top: -20px;">
  <div class="col-md-3">
    <!-- Employee Profile Picture -->
    <div class="box box-default">
      <div class="box-header" style="margin-left: 16px; margin-bottom: -18px;">
        <h3 class="box-title">@yield('button')</h3>
      </div>
      <hr>
      <div class="box-body box-profile">
        @if(empty($employee->avatar))
          <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/avatar/default.jpg') }}" alt="User profile picture">
        @else
          <img class="profile-user-img img-responsive img-circle" src="/images/employees/{{ $employee->avatar }}" alt="User profile picture">
        @endif
        <h3 class="profile-username text-center">{{ ucfirst($employee->employeename) }}</h3>
        <p class="text-muted text-center">
          @php
            use Carbon\Carbon;
            $nowT = Carbon::now();
            $nextY = Carbon::now()->addYear(1)->format('Y');
            $nowY = Carbon::now()->format('Y');
            $dd = $employee->dob->format('d');
            $mm = $employee->dob->format('m');
            $nowBd = Carbon::create($nowY, $mm, $dd, 0);
            $nextBd = Carbon::create($nextY, $mm, $dd, 0);
            if($nowBd > Carbon::now()) {
              echo $nowT->diffInDays($nowBd);
            } else {
              echo $nowT->diffInDays($nextBd);
            }
          @endphp days until Birthday
        </p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item clearfix"><b>
            Phone</b><a class="pull-right">{{ $employee->phone }}</a>
          </li>
          <li class="list-group-item clearfix"><b>
            Email</b><a class="pull-right">{{ $employee->email }}</a>
          </li>
          <li class="list-group-item clearfix"><b>
            Date of Birth (Age)</b><a class="pull-right">{{ $employee->dob != null ? $employee->dob->format('d M Y') : '' }} ({{ $employee->dob != null ? $employee->dob->age : '' }} years old)</a>
          </li>
          <li class="list-group-item clearfix"><b>
            Link to User</b>@if(empty($employee->user_id)) <a class="pull-right">Not Set</a> @else <a class="pull-right" href="{{route('users.edit', $employee->user->id)}}">{{ ucwords($employee->user->name) }} @endif</a>
          </li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- About Me Box -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">About {{ucwords($employee->employeename)}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body"><strong><i class="fa fa-book margin-r-5"></i>
        Education</strong>
        <p class="text-muted">
          {{ $employee->education }}
        </p>
        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i>
        Address</strong>
        <p class="text-muted">{{ $employee->address }}</p>
        <hr>
        <strong><i class="fa fa-pencil margin-r-5"></i>
        Position</strong>
        <p>
          @foreach ($employee->positions as $position)
            <span class="label label-info">{{$position->positionname}}</span>
          @endforeach
        </p>
        <hr>
        <strong><i class="fa fa-file-text-o margin-r-5"></i>
        Quote</strong>
        <p>{{ $employee->quote }}</p>
        <hr>
        <strong><i class="fa fa-file-text-o margin-r-5"></i>
        About</strong>
        <p>{{ $employee->about }}</p>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="box box-default">
      <ul class="nav nav-tabs">
        <li><a data-toggle="tab" aria-expanded="false" style="color: black; font-weight: bold; font-size: 16px; pointer-events: none;">Edit Employee</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" style="margin: 15px;">
          <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('employees.update', $employee->id) }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group @if ($errors->has('noId')) has-error @endif">
              <label class="col-sm-2 control-label">
                No ID
              </label>
              <div class="col-sm-10">
                <input value="{{ $employee->noId }}" type="text" class="form-control" name="noId" id="inputId">
                @if ($errors->has('noId')) <p class="help-block">{{ $errors->first('noId') }}</p> @endif
              </div>
            </div>
            <div class="form-group @if ($errors->has('employeename')) has-error @endif">
              <label for="inputName" class="col-sm-2 control-label">
                Fullname
              </label>
              <div class="col-sm-10">
                <input value="{{ $employee->employeename }}" type="text" class="form-control" name="employeename" id="inputName">
                @if ($errors->has('employeename')) <p class="help-block">{{ $errors->first('employeename') }}</p> @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputDob" class="col-sm-2 control-label">
                Date of Birth
              </label>
              <div class="col-sm-10">
                <input value="{{ $employee->dob != null ? $employee->dob->format('Y-m-d') : '' }}" name="dob" type="text" class="form-control" id="datetimepicker1" data-date-format="YYYY-MM-DD">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPhone" class="col-sm-2 control-label">
                Phone
              </label>
              <div class="col-sm-10">
                <input value="{{ $employee->phone }}" name="phone" type="phone" class="form-control" id="inputPhone">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">
                Email
              </label>
              <div class="col-sm-10">
                <input value="{{ $employee->email }}" name="email" type="email" class="form-control" id="inputEmail">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress" class="col-sm-2 control-label">
                Address
              </label>
              <div class="col-sm-10">
                <input value="{{ $employee->address }}" name="address" type="text" class="form-control" id="inputAddress" placeholder="Address">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEducation" class="col-sm-2 control-label">
                Education
              </label>
              <div class="col-sm-10">
                <input value="{{ $employee->education }}" name="education" type="text" class="form-control" id="inputEducation" placeholder="Education">
              </div>
            </div>
            <!-- statusActive -->
            <div class="form-group">
              <div class="checkbox">
                  <div class="col-sm-offset-2 col-sm-10">
                    <label>
                    <input type="checkbox" name="employeeactive" checked>
                    Active
                  </label>
                  </div>
              </div>
            </div>
            <!-- Position -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Position</label>
              <div class="col-sm-9">
                <select class="form-control select2" name="positions[]" multiple="multiple">
                  @foreach ($positions as $item)
                    <option value="{{ $item->id }}">{{ $item->positionname }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!-- quote -->
            <div class="form-group @if ($errors->has('quote')) has-error @endif">
                <label class="col-sm-2 control-label">Quote</label>
                <div class="col-sm-10">
                  <textarea name="quote" class="form-control" placeholder="Quote">{{$employee->quote}}</textarea>
                </div>
                @if ($errors->has('quote')) <p class="help-block">{{ $errors->first('quote') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="inputAbout" class="col-sm-2 control-label">
                About
              </label>
              <div class="col-sm-10">
                <textarea name="about" class="form-control" rows="5" id="inputAbout" placeholder="About">{{ $employee->about }}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputAvatar" class="col-sm-2 control-label">
                Profile Picture
              </label>
              <div class="col-sm-10">
                <input type="file" name="employee_img" value="" class="form-control" id="inputImg" placeholder="Profile Picture">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <!-- Submit Form Button -->
                {!! Form::submit('Save', ['class' => 'btn btn-success btn-xs']) !!}
                <a href="{{ route('employees.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
              </div>
            </div>
          </form>
          <br>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>
@endsection

@section('scripts')
    <!-- Datetimepicker -->
    <script type="text/javascript" src="{{ asset('src/moment/min/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!-- fullcalendar -->
    <script type="text/javascript" src="/src/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="{{ asset('src/select2/dist/js/select2.min.js') }}"></script>
    <script>
      $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('.select2').select2().val({!! json_encode($employee->positions()->allRelatedIds()) !!}).trigger('change');
      });
      /* Datetimepicker*/
      $(function dateTimePicker() {
        $('#datetimepicker1').datetimepicker({
            sideBySide: true
        });
      });
    </script>
@endsection
