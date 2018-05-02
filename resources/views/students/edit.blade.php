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
        <h3 class="profile-username text-center">{{ ucfirst($student->studentname) }}</h3>
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
        <p class="text-muted">{{ucfirst($student->studentprofile->familystatus)}} {{$student->studentprofile->childno != null ? '/ No '.$student->studentprofile->childno : ''}}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        Family Notes</strong>
        <p>{{ $student->studentprofile->familiynote }}</p>
        <hr>
        <strong><i class="fa fa-heart margin-r-5"></i>
        Health Notes</strong>
        <p>{{ $student->studentprofile->healthnote }}</p>
        <hr>
        <strong><i class="fa fa-reply margin-r-5"></i>
        Previous School</strong>
        <p>{{ $student->studentprofile->prevschool }}</p>
        <hr>
        <strong><i class="fa fa-trophy margin-r-5"></i>
        Achievement Note</strong>
        <p>{{ $student->studentprofile->achievementnote }}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        School Note</strong>
        <p>{{ $student->studentprofile->schoolnote }}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        Previous School Note</strong>
        <p>{{ $student->studentprofile->prevschoolnote }}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        After School Note</strong>
        <p>{{ $student->studentprofile->afterschoolnote }}</p>
        <hr>
        <strong><i class="fa  fa-user margin-r-5"></i>
        Father's Name</strong>
        <p>{{ $student->studentprofile->father }}</p>
        <hr>
        <strong><i class="fa fa-phone margin-r-5"></i>
        Father's Phone</strong>
        <p>{{ $student->studentprofile->fatherphone }}</p>
        <hr>
        <strong><i class="fa fa-envelope margin-r-5"></i>
        Father's Email</strong>
        <p>{{ $student->studentprofile->fatheremail }}</p>
        <hr>
        <strong><i class="fa  fa-user margin-r-5"></i>
        Mother's Name</strong>
        <p>{{ $student->studentprofile->mother }}</p>
        <hr>
        <strong><i class="fa fa-phone margin-r-5"></i>
        Mother's Phone</strong>
        <p>{{ $student->studentprofile->motherphone }}</p>
        <hr>
        <strong><i class="fa fa-envelope margin-r-5"></i>
        Mother's Email</strong>
        <p>{{ $student->studentprofile->motheremail }}</p>
        <hr>
        <strong><i class="fa  fa-user margin-r-5"></i>
        Guardian's Name</strong>
        <p>{{ $student->studentprofile->guardian }}</p>
        <hr>
        <strong><i class="fa fa-phone margin-r-5"></i>
        Guardian's Phone</strong>
        <p>{{ $student->studentprofile->guardianphone }}</p>
        <hr>
        <strong><i class="fa fa-envelope margin-r-5"></i>
        Guardian's Email</strong>
        <p>{{ $student->studentprofile->guardianemail }}</p>
        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i>
        Parent's Address</strong>
        <p>{{ $student->studentprofile->parentaddress }}</p>
        <hr>
        <strong><i class="fa fa-commenting margin-r-5"></i>
        Parent's Note</strong>
        <p>{{ $student->studentprofile->parentnote }}</p>
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
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="form-group @if ($errors->has('noId')) has-error @endif">
              <label class="col-sm-2 control-label">
                No ID / No ID National
              </label>
              <div class="col-sm-5">
                <input value="{{ $student->noId }}" type="text" placeholder="No ID" class="form-control" name="noId">
                @if ($errors->has('noId')) <p class="help-block">{{ $errors->first('noId') }}</p> @endif
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
            <div class="form-group @if ($errors->has('studentname')) has-error @endif">
              <label class="col-sm-2 control-label">
                Fullname
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentname }}" type="text" placeholder="Fullname" class="form-control" name="studentname">
                @if ($errors->has('studentname')) <p class="help-block">{{ $errors->first('studentname') }}</p> @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Nick Name
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentnick }}" type="text" placeholder="Nick Name" class="form-control" name="studentnick">
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
                    <input type="checkbox" name="studentactive" checked>
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
              @if($student->studentprofile->gender == 1)
              <div class="radio col-sm-10">
                <label>
                  <input name="gender" id="optionsRadios1" value="1" type="radio" checked>
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
            @else
              <div class="radio col-sm-10">
                <label>
                  <input name="gender" id="optionsRadios1" value="1" type="radio">
                  Male
                </label>
              </div>
              <label class="col-sm-2 control-label"></label>
              <div class="radio col-sm-10">
                <label>
                  <input name="gender" id="optionsRadios2" value="0" type="radio" checked>
                  Female
                </label>
              </div>
            @endif
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
                <input value="{{ $student->studentprofile->familystatus }}" type="text" placeholder="Family Status" class="form-control" name="familystatus">
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
                <input value="{{ $student->studentprofile->childno }}" type="text" placeholder="Child Number" class="form-control" name="childno">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Family Note
              </label>
              <div class="col-sm-10">
                <textarea name="familiynote" type="text" class="form-control" placeholder="Family Note">{{$student->studentprofile->familiynote}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Health Note
              </label>
              <div class="col-sm-10">
                <textarea name="healthnote" type="text" class="form-control" placeholder="Health Note">{{$student->studentprofile->healthnote}}</textarea>
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
                <input name="prevschool" value="{{$student->studentprofile->prevschool}}" type="text" class="form-control" placeholder="Previous School">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Achievement
              </label>
              <div class="col-sm-10">
                <textarea name="achievementnote" type="text" class="form-control" placeholder="Achievement Note">{{$student->studentprofile->achievementnote}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                School Note
              </label>
              <div class="col-sm-10">
                <textarea name="schoolnote" type="text" class="form-control" placeholder="School Note">{{$student->studentprofile->schoolnote}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Previous School Note
              </label>
              <div class="col-sm-10">
                <textarea name="prevschoolnote" type="text" class="form-control" placeholder="Previous School Note">{{$student->studentprofile->prevschoolnote}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                After School Note
              </label>
              <div class="col-sm-10">
                <textarea name="afterschoolnote" type="text" class="form-control" placeholder="After School Note">{{$student->studentprofile->afterschoolnote}}</textarea>
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
                <input value="{{ $student->studentprofile->fatherphone }}" type="text" placeholder="Father's Phone" class="form-control" name="fatherphone">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Father's Email
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->fatheremail }}" type="text" placeholder="Father's Email" class="form-control" name="fatheremail">
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
                <input value="{{ $student->studentprofile->motherphone }}" type="text" placeholder="Mother's Phone" class="form-control" name="motherphone">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Mother's Email
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->motheremail }}" type="text" placeholder="Mother's Email" class="form-control" name="motheremail">
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
                <input value="{{ $student->studentprofile->guardianphone }}" type="text" placeholder="Guardian's Phone" class="form-control" name="guardianphone">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Guardian's Email
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->guardianemail }}" type="text" placeholder="Guardian's Email" class="form-control" name="guardianemail">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Parents Address
              </label>
              <div class="col-sm-10">
                <input value="{{ $student->studentprofile->parentaddress }}" type="text" placeholder="Parents Address" class="form-control" name="parentaddress">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">
                Parents Note
              </label>
              <div class="col-sm-10">
                <textarea name="parentnote" type="text" class="form-control" placeholder="Parents Note">{{$student->studentprofile->parentnote}}</textarea>
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
