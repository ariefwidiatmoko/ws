@extends('layouts.dashboard')

@section('title', 'Classroom - List Students')
@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/yellow.css">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')
  <a href="{{ route('classroomstudent.index') }}" class="btn btn-xs btn-default">Back</a>
@endsection

@section('content')
<div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
<div class="box box-primary collapsed-box" style="margin-top: 20px;">
  <div class="box-header">
    <div class="col-md-6">
      @yield('navmenu')
    </div>
    <div class="col-md-12 row" style="margin-top: 15px;">
      <div class="col-xs-5 col-md-3 text-right">
        @yield('searchbox')
      </div>
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
        <div class="col-md-6">
          <table id="inlist" class="table table-bordered table-hover">
            <thead>
              <tr>
                  <th style="text-align: center;">No</th>
                  <th>ID / National ID</th>
                  <th>Name</th>
                </tr>
                {{ csrf_field() }}
              </thead>
              <tbody>
              @forelse ($result as $index => $item)
                <tr>
                  <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                  <td>{{$item->noId}} / {{$item->noIdNational}}</td>
                  <td>{{ ucfirst($item->studentname) }}</td>
                </tr>
              @empty
                <tr>
                  <td>No Students (<a href="{{route('setstudents.index')}}">Allocate Classroom - Student</a>)</td>
                </tr>
              @endforelse
              </tbody>
            </table>
            <div class="col-sm-5">
              <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>{{ $result->total() }} students</b></div>
            </div>
          </div>
          <div class="col-md-1">
          </div>
            <div class="col-md-4">
              <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-green">
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('images/avatar/default.jpg') }}" alt="User Avatar">
                  </div>
                  <!-- /.widget-user-image -->
                  <h3 class="widget-user-username">Classroom {{strtoupper($class->classroomname)}}</h3>
                  <h5 class="widget-user-desc">Homeroom Teacher: Not Set</h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    @if (isset($yr))
                      <li><a href="#"><b>Year</b> <span class="pull-right badge bg-blue">{{$yr->yearname}}</span></a></li>
                      <li><a href="#"><b>Grade</b> <span class="pull-right badge bg-aqua">Grade {{strtoupper($class->grade->gradename)}}</span></a></li>
                      <li><a href="#"><b>Total Students</b> <span class="pull-right badge bg-green">{{ $result->total() }} students</span></a></li>
                      <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                    @else
                      No Data
                    @endif
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-1">

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
