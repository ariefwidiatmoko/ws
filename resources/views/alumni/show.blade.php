@extends('layouts.dashboard')

@section('title', 'Detail Alumni')

@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/yellow.css">
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('alumni.index') }}">Alumni</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('alumni.index') }}" class="btn btn-xs btn-default"></i> Back</a>
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
      <div class="box box-default">
        <div class="box-header" style="margin-left: 16px; margin-bottom: -18px;">
          <h3 class="box-title">@yield('button')</h3>
        </div>
        <hr>
        <div class="box-body box-profile" style="margin: 0px 18px 0px 18px;">
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
                $bdnow = $nowT->diffInDays($nowBd);
                if ($bdnow <= 72) {
                  echo $nowT->diffInDays($nowBd) . 'days until Birthday';
                }
              } else {
                $bdlater = $nowT->diffInDays($nextBd);
                if ($bdlater <= 72) {
                  echo $nowT->diffInDays($nextBd) . 'days until Birthday';
                }
              }
            } else {
              echo '-';
            }
            @endphp
          </p>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item clearfix"><b>
              No ID / ID National</b><a class="pull-right">{{ $student->noId }} / {{ $student->noIdNational }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Name</b><a class="pull-right">{{ $student->studentname }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Alias</b><a class="pull-right">{{ $student->studentnick != null ? ucwords($student->studentnick) : '-' }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Set Student</b><a class="pull-right"><input type="checkbox" class="statusActive" data-id="{{$student->id}}" @if ($student->studentactive) checked @endif></a>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- About Me Box -->
      <div class="box box-default" style="margin-top: -20px;">
        <div class="box-header with-border" style="margin-left: 14px;">
          <h3 class="box-title">History Academic</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive" style="margin-left: 14px;">
          <table class="table table-hover" style="margin-top: -10px;">
            <tbody>
              <tr>
                <td>No</td>
                <td>Year</td>
                <td>Semester</td>
                <td>Grade</td>
                <td>Classroom</td>
              </tr>
              @forelse ($histories as $index => $item)
              <tr>
                <td>{{$index += 1}}</td>
                <td>{{$item->yearname}}</td>
                <td>{{$item->semestername}}</td>
                <td>{{$item->gradename}}</td>
                <td>{{$item->classroomname}}</td>
              </tr>
            @empty
              <tr><td>No Data</td></tr>
            @endforelse
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
      <div class="box box-default">
        <ul class="nav nav-tabs">
          <li><a data-toggle="tab" aria-expanded="false" style="color: black; font-weight: bold; font-size: 16px; pointer-events: none;">Detail Profile</a></li>
        </ul>
        <div class="tab-content">
        <!-- About Me Box -->
        <div class="box box-default">
          <!-- /.box-header -->
          <div class="box-body">
            <strong><i class="fa fa-newspaper-o margin-r-5"></i>
            Place & Date of Birth</strong>
            <p class="text-muted">{{ucfirst($student->studentprofile->pob != null ? $student->studentprofile->pob.', ' : '')}}{{ $student->studentprofile->dob != null ? $student->studentprofile->dob->format('d M Y') : ''}}</p>
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
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.tab-content -->
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
@endsection

@section('scripts')
  <!-- toastr notifications -->
  <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>

  <!-- icheck checkboxes -->
  <script type="text/javascript" src="/src/iCheck/icheck.min.js"></script>
  <script>
      $(document).ready(function(){
          $('.statusActive').iCheck({
              checkboxClass: 'icheckbox_square-yellow',
              radioClass: 'iradio_square-yellow',
              increaseArea: '20%'
          });
          $('.statusActive').on("ifClicked", function(event){
              id = $(this).data('id');
              $.ajax({
                  type: 'POST',
                  url: "{{ URL::route('students.statusActive') }}",
                  data: {
                      '_token': $('input[name=_token]').val(),
                      'id': id
                  },
                  success: function(data) {
                      window.location.href = "{{route('alumni.index')}}";
                  },
              });
          });
          $('.statusActive').on('ifToggled', function(event) {
              $(this).closest('tr').toggleClass('warning');
          });
      });
  </script>
@endsection
