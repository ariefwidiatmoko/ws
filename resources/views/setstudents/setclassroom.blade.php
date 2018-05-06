@extends('layouts.dashboard')

@section('title', 'Set Classroom')

@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/blue.css">

  <style>
      table, td, th {
        border: 1px solid black;
      }

      table {
        border-collapse: collapse;
        width: 100%;
      }

      th {
        vertical-align: baseline;
      }
  </style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('setstudents.index') }}">Students</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('students.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Student..">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
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
      <div class="box-header" style="margin-left: -15px">
        <h3 class="box-title col-xs-12" style="margin-top: 15px">@yield('btn1')</h3>
        <h3 class="box-title col-xs-12">@yield('btn2')</h3>
      </div>
      <!-- /.box-header -->
      <div id="inlist" class="table-responsive box-body">
          <div class="row">
            <div class="col-sm-12">
              <table id="inlist" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th style="text-align: center; vertical-align: middle;" rowspan="3">ID</th>
                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Name</th>
                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Year</th>
                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Grade</th>
                    <th style="text-align: center;" colspan="6">Classroom</th>
                  </tr>
                  <tr>
                    @foreach ($classrooms as $index => $cr)
                      <th style="text-align: center;">{{$cr->classroomname}} <br><input type="checkbox" name="classroom" class="{{$cr->classroom_id}}-selectall" value="{{$cr->classroom_id}}"></th>
                    @endforeach
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody>
                  @foreach ($results as $index => $item)
                    <tr>
                      <td style="text-align: center;">{{ucwords($item->noId)}}</td>
                      <td style="text-align: center;">{{ucwords($item->studentname)}}</td>
                      <td style="text-align: center;">{{ucwords($item->yearname)}}</td>
                      <td style="text-align: center;">{{ucwords($item->gradename)}}</td>
                      @foreach ($classrooms as $index => $cr)
                        <td style="text-align: center;">
                          <input id="iradio" type="radio"
                          data-id="{{$item->id}}"
                          data-std="{{$item->student_id}}"
                          data-yrd="{{$item->year_id}}"
                          data-grd="{{$item->grade_id}}"
                          data-crs="{{$cr->classroom_id}}"
                          name="{{$item->id}}-classroom_id"
                          class="{{$cr->classroom_id}}-selector crs"
                          @if ($cr->classroom_id == $item->classroom_id) checked @endif @if ($cr->grade_id != $item->grade_id) disabled @endif>
                        </td>
                      @endforeach
                    </tr>
                  @endforeach
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

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="/src/iCheck/icheck.min.js"></script>
    @include('shared._part_notification')
    <script>
        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
            @foreach ($classrooms as $index => $cr)
              $('.{{$cr->classroom_id}}-selectall').on('ifToggled', function (event) {
                  var chkToggle;
                  $(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
                  $('input.{{$cr->classroom_id}}-selector:not(.all)').iCheck(chkToggle);
              });
            @endforeach

            $('.crs').on("ifClicked", function(event){
                id = $(this).data('id');
                student_id = $(this).data('std');
                year_id = $(this).data('yrd');
                grade_id = $(this).data('grd');
                classroom_id = $(this).data('crs');
                $.ajax({
                    type: 'PUT',
                    url: "{{ URL::route('setstudents.allocateClassroom') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id,
                        'student_id': student_id,
                        'year_id': year_id,
                        'grade_id': grade_id,
                        'classroom_id': classroom_id
                    },
                    success: function(data) {
                        // empty
                    },
                });
            });
            $('.statusActive').on('ifToggled', function(event) {
                $(this).closest('tr').toggleClass('warning');
            });
        });
    </script>
@endsection
