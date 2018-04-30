@extends('layouts.dashboard')

@section('title', 'Edit Student')

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
  <a href="{{ route('students.index') }}">Students</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('students.index') }}" class="btn btn-xs btn-default"></i> Back</a>
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
  <div class="col-md-4">
    <!-- Employee Profile Picture -->
    <div class="box box-default">
      <div class="box-header" style="margin-left: 16px; margin-bottom: -18px;">
        <h3 class="box-title">@yield('button')</h3>
      </div>
      <hr>
      <div class="box-body box-profile">
        @if(empty($student->studentprofile->avatar))
          <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/avatar/default.jpg') }}" alt="User profile picture">
        @else
          <img class="profile-user-img img-responsive img-circle" src="/images/students/{{ $student->studentprofile->avatar }}" alt="User profile picture">
        @endif
        <h3 class="profile-username text-center">{{ ucfirst($student->fullname) }}</h3>
        <p class="text-muted text-center">
          @php
          use Carbon\Carbon;
          if(isset($student->studentprofile->dob)) {
            $nowT = Carbon::now();
            $nextY = Carbon::now()->addYear(1)->format('Y');
            $nowY = Carbon::now()->format('Y');
            $dd = $student->studentprofile->dob->format('d');
            $mm = $student->studentprofile->dob->format('m');
            $nowBd = Carbon::create($nowY, $mm, $dd, 0);
            $nextBd = Carbon::create($nextY, $mm, $dd, 0);
            if($nowBd > Carbon::now()) {
              echo $nowT->diffInDays($nowBd);
            } else {
              echo $nowT->diffInDays($nextBd);
            }
          } else {
            echo '-';
          }
          @endphp days until Birthday
        </p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item clearfix"><i class="fa fa-phone margin-r-5"></i><b>
            Phone</b><a class="pull-right">{{ $student->studentprofile->phone }}</a>
          </li>
          <li class="list-group-item clearfix"><i class="fa fa-envelope margin-r-5"></i> <b>
            Email</b><a class="pull-right">{{ $student->studentprofile->email }}</a>
          </li>
          <li class="list-group-item clearfix"><i class="fa fa-map-marker margin-r-5"></i><b>
            Address</b><a class="pull-right">{{ $student->studentprofile->address}}</a>
          </li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- About Me Box -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Detail Profile</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <strong><i class="fa fa-newspaper-o margin-r-5"></i>
        Place & Date of Birth</strong>
        <p class="text-muted">{{ucfirst($student->studentprofile->pob)}}{{ $student->studentprofile->dob != null ? ', '.$student->studentprofile->dob->format('d M Y') : ''}}</p>
        <hr>
        <strong><i class="fa fa-venus-mars margin-r-5"></i>
        Gender</strong>
        <p class="text-muted">@if (isset($student->studentprofile->gender))
          {{$student->studentprofile->gender == 1 ? 'Male' : 'Female'}}
        @endif</p>
        <hr>
        <strong><i class="fa fa-flag margin-r-5"></i>
        Citizenship</strong>
        <p class="text-muted">{{ucfirst($student->studentprofile->citizenship)}}</p>
        <hr>
        <strong><i class="fa fa-users margin-r-5"></i>
        Siblings</strong>
        <p class="text-muted">{{ucfirst($student->studentprofile->siblings)}}</p>
        <hr>
        <strong><i class="fa fa-sitemap margin-r-5"></i>
        Family Status / Child No</strong>
        <p class="text-muted">{{ucfirst($student->studentprofile->familyStatus)}} {{$student->studentprofile->childNo != null ? '/ No '.$student->studentprofile->childNo : ''}}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        Family Notes</strong>
        <p>{{ $student->studentprofile->familiyNote }}</p>
        <hr>
        <strong><i class="fa fa-heart margin-r-5"></i>
        Health Notes</strong>
        <p>{{ $student->studentprofile->healthNote }}</p>
        <hr>
        <strong><i class="fa fa-reply margin-r-5"></i>
        Previous School</strong>
        <p>{{ $student->studentprofile->previousSchool }}</p>
        <hr>
        <strong><i class="fa fa-trophy margin-r-5"></i>
        Achievement Note</strong>
        <p>{{ $student->studentprofile->achievementNote }}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        School Note</strong>
        <p>{{ $student->studentprofile->schoolNote }}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        Previous School Note</strong>
        <p>{{ $student->studentprofile->prevScNote }}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        After School Note</strong>
        <p>{{ $student->studentprofile->afterScNote }}</p>
        <hr>
        <strong><i class="fa  fa-user margin-r-5"></i>
        Father's Name</strong>
        <p>{{ $student->studentprofile->father }}</p>
        <hr>
        <strong><i class="fa fa-phone margin-r-5"></i>
        Father's Phone</strong>
        <p>{{ $student->studentprofile->fphone }}</p>
        <hr>
        <strong><i class="fa fa-envelope margin-r-5"></i>
        Father's Email</strong>
        <p>{{ $student->studentprofile->femail }}</p>
        <hr>
        <strong><i class="fa  fa-user margin-r-5"></i>
        Mother's Name</strong>
        <p>{{ $student->studentprofile->mother }}</p>
        <hr>
        <strong><i class="fa fa-phone margin-r-5"></i>
        Mother's Phone</strong>
        <p>{{ $student->studentprofile->mphone }}</p>
        <hr>
        <strong><i class="fa fa-envelope margin-r-5"></i>
        Mother's Email</strong>
        <p>{{ $student->studentprofile->memail }}</p>
        <hr>
        <strong><i class="fa  fa-user margin-r-5"></i>
        Guardian's Name</strong>
        <p>{{ $student->studentprofile->guardian }}</p>
        <hr>
        <strong><i class="fa fa-phone margin-r-5"></i>
        Guardian's Phone</strong>
        <p>{{ $student->studentprofile->gphone }}</p>
        <hr>
        <strong><i class="fa fa-envelope margin-r-5"></i>
        Guardian's Email</strong>
        <p>{{ $student->studentprofile->gemail }}</p>
        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i>
        Parent's Address</strong>
        <p>{{ $student->studentprofile->paddress }}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        Parent's Note</strong>
        <p>{{ $student->studentprofile->parentNote }}</p>
        <hr>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-8">
    <div class="box box-default">
      <ul class="nav nav-tabs">
        <li><a data-toggle="tab" aria-expanded="false" style="color: black; font-weight: bold; font-size: 16px; pointer-events: none;">Edit Student</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" style="margin: 15px;">
          <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('students.update', $student->id) }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group">
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <label class="col-sm-2 control-label">
                No ID / No ID National
              </label>
              <div class="col-sm-5">
                <input value="{{ $student->noId }}" type="text" placeholder="No ID" class="form-control" name="noId">
              </div>
              <div class="col-sm-5">
                <input value="{{ $student->noIdNational }}" type="text" placeholder="No ID National" class="form-control" name="noIdNational">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Profile Picture
              </label>
              <div class="col-sm-10">
                <input type="file" name="student_img" value="" class="form-control" placeholder="Profile Picture">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Fullname
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->fullname }}" type="text" placeholder="Fullname" class="form-control" name="fullname">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Nick Name
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->nickName }}" type="text" placeholder="Nick Name" class="form-control" name="nickName">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Phone
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->phone }}" type="text" placeholder="Phone" class="form-control" name="phone">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Email
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->email }}" type="text" placeholder="Email" class="form-control" name="email">
              </div>
            </div>
            <!-- statusActive -->
            <div class="form-group">
              <div class="checkbox">
                  <div class="col-sm-offset-2 col-sm-10">
                    <label>
                    <input type="checkbox" name="statusActive" checked>
                    Active
                  </label>
                  </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Place & Date of Birth
              </label>
              <div class="col-sm-5">
                <input value="{{ $student->studentprofile->pob }}" type="text" class="form-control" placeholder="Place of Birth" name="pob">
              </div>
              <div class="col-sm-5">
                <input value="{{ $student->studentprofile->dob != null ? $student->studentprofile->dob->format('Y-m-d') : '' }}" name="dob" type="text" class="form-control" id="datetimepicker1" data-date-format="YYYY-MM-DD">
              </div>
            </div>
            <!-- Gender -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Gender</label>
              <div class="radio col-sm-10">
                <label>
                  <input name="gender" id="optionsRadios1" value="1" type="radio">
                  Male
                </label>
              </div>
              <label class="col-sm-2 control-label"></label>
              <div class="radio col-sm-10">
                <label>
                  <input name="gender" id="optionsRadios2" value="0" type="radio">
                  Female
                </label>
              </div>
            </div>
            @if ($errors->has('gender'))<span class="help-block">{{$errors->first('gender')}}</span> @endif
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Citizenship
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->citizenship }}" type="text" placeholder="Citizenship" class="form-control" name="citizenship">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Family Status
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->familyStatus }}" type="text" placeholder="Family Status" class="form-control" name="familyStatus">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Siblings / Child Number
              </label>
              <div class="col-sm-5">
                <input value="{{ $student->studentprofile->siblings }}" type="text" placeholder="Siblings" class="form-control" name="siblings">
              </div>
              <div class="col-sm-5">
                <input value="{{ $student->studentprofile->childNo }}" type="text" placeholder="Child Number" class="form-control" name="childNo">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Family Note
              </label>
              <div class="col-sm-10">
                <textarea name="familiyNote" type="text" class="form-control" placeholder="Family Note">{{$student->studentprofile->familiyNote}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Health Note
              </label>
              <div class="col-sm-10">
                <textarea name="healthNote" type="text" class="form-control" placeholder="Health Note">{{$student->studentprofile->healthNote}}</textarea>
              </div>
            </div>
            <hr>
            <div class="box-header" style="margin: -20px 0px -20px 0px;">
              <h3 class="box-title"><span class="label label-info">School Related Info</span></h3>
            </div>
            <hr>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Previus School
              </label>
              <div class="col-sm-10">
                <input name="previousSchool" value="{{$student->studentprofile->previousSchool}}" type="text" class="form-control" placeholder="Previous School">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Achievement
              </label>
              <div class="col-sm-10">
                <textarea name="achievementNote" type="text" class="form-control" placeholder="Achievement Note">{{$student->studentprofile->achievementNote}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                School Note
              </label>
              <div class="col-sm-10">
                <textarea name="schoolNote" type="text" class="form-control" placeholder="School Note">{{$student->studentprofile->schoolNote}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Previous School Note
              </label>
              <div class="col-sm-10">
                <textarea name="prevScNote" type="text" class="form-control" placeholder="Previous School Note">{{$student->studentprofile->prevScNote}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                After School Note
              </label>
              <div class="col-sm-10">
                <textarea name="afterScNote" type="text" class="form-control" placeholder="After School Note">{{$student->studentprofile->afterScNote}}</textarea>
              </div>
            </div>
            <hr>
            <div class="box-header" style="margin: -20px 0px -20px 0px;">
              <h3 class="box-title"><span class="label label-info">Parents Related Info</span></h3>
            </div>
            <hr>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Father's Name
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->father }}" type="text" placeholder="Father's Name" class="form-control" name="father">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Father's Phone
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->fphone }}" type="text" placeholder="Father's Phone" class="form-control" name="fphone">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Father's Email
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->father }}" type="text" placeholder="Father's Email" class="form-control" name="father">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Mother's Name
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->mother }}" type="text" placeholder="Mother's Name" class="form-control" name="mother">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Mother's Phone
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->mphone }}" type="text" placeholder="Mother's Phone" class="form-control" name="mphone">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Mother's Email
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->memail }}" type="text" placeholder="Mother's Email" class="form-control" name="memail">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Guardian's Name
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->guardian }}" type="text" placeholder="Guardian's Name" class="form-control" name="guardian">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Guardian's Phone
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->gphone }}" type="text" placeholder="Guardian's Phone" class="form-control" name="gphone">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Guardian's Email
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->gemail }}" type="text" placeholder="Guardian's Email" class="form-control" name="gemail">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Parents Address
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->paddress }}" type="text" placeholder="Parents Address" class="form-control" name="paddress">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Parents Note
              </label>
              <div class="col-sm-10">
                <textarea name="parentNote" type="text" class="form-control" placeholder="Parents Note">{{$student->studentprofile->parentNote}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <!-- Submit Form Button -->
                {!! Form::submit('Save', ['class' => 'btn btn-success btn-xs']) !!}
                <a href="{{ route('students.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
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
    <!-- toastr notifications -->
    <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>
    <!-- fullcalendar -->
    <script type="text/javascript" src="/src/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="{{ asset('src/select2/dist/js/select2.min.js') }}"></script>
    <script>
      /* Datetimepicker*/
      $(function dateTimePicker() {
        $('#datetimepicker1').datetimepicker({
            sideBySide: true
        });
      });
    </script>
@endsection
