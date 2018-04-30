@extends('layouts.dashboard')

@section('title', 'Show Student Academic Years')

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('studentyears.index') }}">Students</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('studentyears.index') }}" class="btn btn-xs btn-default">Back</a>
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
              Name</b><a class="pull-right">{{ $studentyear->name }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Alias</b><a class="pull-right">{{ $studentyear->alias != null ? ucwords($studentyear->alias) : '-' }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Created By</b><a class="pull-right">{{ $studentyear->user->id ? ucwords($studentyear->user->name).' - '.$studentyear->created_at->format('d M Y - H:i:s') : '-' }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Updated By</b><a class="pull-right">{{ $studentyear->user->id ? ucwords($studentyear->updated_by) : ucwords($studentyear->user->name) }}</a>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- About Me Box -->
      <div class="box box-default">
        <div class="box-header with-border" style="margin-left: 14px;">
          <h3 class="box-title">Student Academic Years</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive" style="margin-left: 14px;">
          <table class="table table-hover" style="margin-top: -10px;">
            <tbody>
              @forelse ($studentyear->classyears as $index => $item)
              <tr>
                <td>{{$index += 1}}</td>
                <td>Classroom {{$studentyear->name}}</td>
                <td>{{$item->year ? $item->year->name : ''}}</td>
                <td>{{$item->semester ? $item->semester->name : ''}}</td>
                <td>
                  <form action="{{ route('studentyears.delYear', $item->id) }}" method="post">
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
          <li><a data-toggle="tab" aria-expanded="false" style="color: black; font-weight: bold; font-size: 16px; pointer-events: none;">Set Grade</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" style="margin: 15px;">
            <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('studentyears.updateGrade', $studentyear->id) }}" method="POST">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">
                  Select Grade
                </label>
                  <input type="hidden" name="updated_by" value="{{Auth::user()->name}}">
                <div class="col-sm-10">
                  <select class="form-control" name="grade_id" size="5">
                    @foreach ($grades as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <!-- Submit Form Button -->
                  {!! Form::submit('Set Grade', ['class' => 'btn btn-success btn-xs']) !!}
                </div>
              </div>
            </form>
            <br>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <div class="box box-default">
        <ul class="nav nav-tabs">
          <li><a data-toggle="tab" aria-expanded="false" style="color: black; font-weight: bold; font-size: 16px; pointer-events: none;">Add Year</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" style="margin: 15px;">
            <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('studentyears.updateYear', $studentyear->id) }}" method="POST">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">
                  Select Year
                </label>
                <div class="col-sm-10">
                  <select class="form-control" name="years[]" size="10">
                    @foreach ($years as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <!-- Submit Form Button -->
                  {!! Form::submit('Save', ['class' => 'btn btn-success btn-xs']) !!}
                  <a href="{{ route('studentyears.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
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

@endsection
