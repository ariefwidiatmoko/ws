@extends('layouts.dashboard')

@section('title', 'Show Student History')

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('setstudents.index') }}">Students</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('setstudents.index') }}" class="btn btn-xs btn-default">Back</a>
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
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item clearfix"><b>
              No ID</b><a class="pull-right">{{ $student->noId }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              No ID National</b><a class="pull-right">{{ $student->noIdNational }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Name</b><a class="pull-right">{{ $student->studentname }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Alias</b><a class="pull-right">{{ $student->studentnick != null ? ucwords($student->studentnick) : '-' }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Created By</b><a class="pull-right">{{ $student->user->id ? ucwords($student->user->name).' - '.$student->created_at->format('d M Y - H:i:s') : '-' }}</a>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- About Me Box -->
      <div class="box box-default">
        <div class="box-header with-border" style="margin-left: 14px;">
          <h3 class="box-title">Student - Year</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive" style="margin-left: 14px;">
          <table class="table table-hover" style="margin-top: -10px;">
            <tbody>
              @forelse ($histories as $index => $item)
              <tr>
                <td>{{$index += 1}}</td>
                <td>{{ucwords($item->studentname)}}</td>
                <td>{{$item->yearname}}</td>
                <td>{{$item->semestername}}</td>
                <td>{{$item->gradename}}</td>
                <td>{{$item->classroomname}}</td>
                <td>
                  <form action="{{ route('setstudents.delYear', $item->id) }}" method="post">
                    <button type="submit" role="button" class="btn btn-xs btn-danger">Delete</button>
                    {{ csrf_field() }}
                  </form>
                </td>
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
          <li><a data-toggle="tab" aria-expanded="false" style="color: black; font-weight: bold; font-size: 16px; pointer-events: none;">Add Classroom</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" style="margin: 15px;">
            <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('setstudents.addClassroom', $student->id) }}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="col-sm-2 control-label">
                  Select Year
                </label>
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <div class="col-sm-10">
                  <select class="form-control" name="year_id" size="5">
                    @foreach ($years as $item)
                      <option value="{{ $item->id }}">{{ $item->yearname }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">
                  Select Grade
                </label>
                <div class="col-sm-10">
                  <select class="form-control" name="grade_id" size="5">
                    @foreach ($grades as $item)
                      <option value="{{ $item->id }}">{{ $item->gradename }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">
                  Select Classroom
                </label>
                <div class="col-sm-10">
                  <select class="form-control" name="classroom_id" size="5">
                    @foreach ($classrooms as $item)
                      <option value="{{ $item->id }}">{{ $item->classroomname }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <!-- Submit Form Button -->
                  {!! Form::submit('Add Classroom', ['class' => 'btn btn-success btn-xs']) !!}
                </div>
              </div>
            </form>
            <br>
          </div>
          <!-- /.tab-pane -->
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
@include('shared._part_notification')
@endsection
