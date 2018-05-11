@extends('layouts.dashboard')

@section('title', 'Edit Student')

@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/yellow.css">
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
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
  <div class="col-md-5">
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
          <li class="list-group-item clearfix"><i class="fa fa-phone fa-fw margin-r-5"></i><b>
            Phone</b><a class="pull-right">{{ $student->studentprofile->phone }}</a>
          </li>
          <li class="list-group-item clearfix"><i class="fa fa-envelope fa-fw margin-r-5"></i> <b>
            Email</b><a class="pull-right">{{ $student->studentprofile->email }}</a>
          </li>
          <li class="list-group-item clearfix"><i class="fa fa-map-marker fa-fw margin-r-5"></i><b>
            Address</b><a class="pull-right">{{ $student->studentprofile->address}}</a>
          </li>
          <li class="list-group-item clearfix"><i class="fa fa-mortar-board fa-fw margin-r-5"></i><b>
            Set Alumni</b><a class="pull-right"><input type="checkbox" class="statusActive" data-id="{{$student->id}}" @if ($student->studentactive == 0) checked @endif></a>
          </li>
          <li class="list-group-item clearfix"><i class="fa fa-warning fa-fw margin-r-5"></i><b>
            Delete Student</b><a class="pull-right">
                @can ('delete_students')
                  {!! Form::open( ['method' => 'delete', 'url' => route('students.destroy', $student->id), 'onSubmit' => 'return confirm("Are you sure you want to delete it?")']) !!}
                    <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>
                  {!! Form::close() !!}
                @endcan</a>
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
    <!-- About Me Box -->
    <div class="box box-default" style="margin-top: -20px;">
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
  <div class="col-md-7">
    <div class="box box-default">
      <ul class="nav nav-tabs">
        <li><a data-toggle="tab" aria-expanded="false" style="color: black; font-weight: bold; font-size: 16px; pointer-events: none;">Edit Student</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" style="margin: 15px;">
          <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('students.update', $student->id) }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            @include('students._form_edit')
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
    <!-- toastr notifications -->
    <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="/src/iCheck/icheck.min.js"></script>
    <script>
      /* Datetimepicker*/
      $(function dateTimePicker() {
        $('#datetimepicker1').datetimepicker({
            sideBySide: true
        });
      });
    </script>
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
                        window.location.href = "{{route('students.index')}}";
                    },
                });
            });
            $('.statusActive').on('ifToggled', function(event) {
                $(this).closest('tr').toggleClass('warning');
            });
        });
    </script>
@endsection
