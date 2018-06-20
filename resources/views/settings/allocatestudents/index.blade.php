@extends('layouts.dashboard')

@section('title', 'Allocate Students')

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
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('btn1')
 @include('settings.allocatestudents._filterstudent')
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
        @if(!empty($request->year_id))
          <h3 class="box-title col-xs-12" style="margin-top: -10px; margin-left: 15px;"><a href="{{route('allocatestudents.index')}}" class="btn btn-xs btn-default">Back</a></h3>
        @endif
      </div>
      <!-- /.box-header -->
      <div id="inlist" class="table-responsive box-body">
          <div class="row">
            <div class="col-sm-12">
              <table id="inlist" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th style="text-align: center; vertical-align: middle;" rowspan="2">No</th>
                    <th style="text-align: center; vertical-align: middle;" rowspan="2">ID</th>
                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Name</th>
                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Year</th>
                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Grade</th>
                    @if ($request->year_id)
                      <th style="text-align: center;" colspan="6">Classroom</th>
                    @endif
                  </tr>
                  @if(!empty($request->year_id))
                    <tr>
                      @foreach ($classrooms as $index => $cr)
                        <th style="text-align: center;">{{$cr->classroomname}}</th>
                      @endforeach
                    </tr>
                  @endif
                  {{ csrf_field() }}
                </thead>
                <tbody>
                  @forelse ($results as $index => $item)
                    <tr>
                      <td style="text-align: center;">{{ $index + $results->firstItem() }}</td>
                      <td style="text-align: center;">{{ucwords($item->noId)}}</td>
                      <td style="text-align: center;">{{ucwords($item->studentname)}}</td>
                      <td style="text-align: center;">{{ucwords($item->yearname)}}</td>
                      <td style="text-align: center;">{{ucwords($item->gradename)}}</td>
                      @if(!empty($request->year_id))
                        @foreach ($classrooms as $index => $cr)
                          <td style="text-align: center;">
                            @if ($cr->grade_id == $item->grade_id)
                              <input id="iradio" type="radio"
                              data-id="{{$item->id}}"
                              data-std="{{$item->student_id}}"
                              data-yrd="{{$item->year_id}}"
                              data-grd="{{$item->grade_id}}"
                              data-crs="{{$cr->classroom_id}}"
                              name="{{$item->id}}-classroom_id"
                              class="{{$cr->classroom_id}}-selector crs"
                              @if ($cr->classroom_id == $item->classroom_id) checked @endif>
                            @endif
                          </td>
                        @endforeach
                      @endif
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4">No Student</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
              <div id="result"></div>
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
                    url: "{{ URL::route('allocatestudents.update') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id,
                        'student_id': student_id,
                        'year_id': year_id,
                        'grade_id': grade_id,
                        'classroom_id': classroom_id
                    },
                    success: function(data) {

                    },
                });
            });
            $('.statusActive').on('ifToggled', function(event) {
                $(this).closest('tr').toggleClass('warning');
            });
        });
    </script>
@endsection
