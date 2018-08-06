@extends('layouts.dashboard')

@section('title', 'Students')

@section('stylesheets')
<style media="screen">
  tr>td {
          cursor: pointer;
        }
  tr>td:hover {
                color: #458dd5;
              }
</style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Academics</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('classroomstudent.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Classroom..">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('btn1')
 @include('academics.students._filterstudent')
@endsection

@section('button')
  @include('academics.students.actionRequest')
@endsection

@section('content')
<div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
<div class="box box-primary collapsed-box" style="margin-top: 20px;">
  <div class="box-header">
    <div class="col-md-6">
      @yield('navmenu')
    </div>
    <div class="col-md-12 row" style="margin-top: 15px;">
      <div class="col-xs-12 col-md-12 text-right" style="margin-top: 1px;">
        @yield('btn1')
        @yield('button')
      </div>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
</div>
    <div class="box" style="margin-top: -20px;">
      <!-- /.box-header -->
      <div id="inlist" class="table-responsive box-body">
          <div class="row">
            <div class="col-sm-12">
              <table id="inlist" class="table table-hover">
                <thead>
                  <tr>
                      <th style="width: 5%; text-align: center;">No</th>
                      <th style="width: 5%; text-align: center;">No ID</th>
                      <th style="width: 5%;">Student</th>
                      <th style="width: 5%; text-align: center;">Classroom</th>
                      <th style="width: 5%; text-align: center;">Grade</th>
                      <th style="width: 5%; text-align: center;">Year</th>
                    </tr>
                    {{ csrf_field() }}
                  </thead>
                  <tbody>
                  @forelse ($result as $index => $item)
                    <tr class="clickable-row" data-href="{{route('students.edit', $item->student_id)}}">
                      <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                      <td style="text-align: center;">{{ ucfirst($item->noId) }}</td>
                      <td>{{ ucfirst($item->studentname) }}</td>
                      <td style="text-align: center;">{{ $item->classroomname ? ucfirst($item->classroomname) : '-'}}</td>
                      <td style="text-align: center;">Grade {{ucwords($item->gradename)}}</td>
                      <td style="text-align: center;">{{$item->yearname}}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5">No Student</td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} Students )</div>
              </div>
              <div class="col-sm-7 text-right" style="margin-top: -34px;">
                {!! $result->appends(Request::all())->render() !!}
              </div>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
</div>
@endsection

@section('scripts')
    @include('shared._part_notification')
    {{--clickable Row--}}
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection
