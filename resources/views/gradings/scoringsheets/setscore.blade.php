@extends('layouts.dashboard')

@section('title', 'Detail Scoringsheet : Classroom ' . $classroom->classroomname . ' | ' . ucwords($subject->subjectname) . ' | ' . $year->yearname . ' | ' . $semester->semestername . ' | created by : ' . ucwords($classsubject->created_by))

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Gradings</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a href="{{route('scoringsheets.index')}}">Scoringsheets</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Setting Scoringsheet</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')
  <div class="row">
    <a href="{{ route('scoringsheets.show', $classsubject->csbatch_id)}}" class="btn btn-xs btn-default">Back</a>
    <a href="{{route('scoringsheets.inputscore', $classsubject->csbatch_id)}}" class="btn btn-xs btn-info">Input</a>
  </div>
@endsection

@section('content')
<div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
<div class="box box-primary collapsed-box" style="margin-top: 20px;">
  <div class="box-header">
    <div class="col-md-12" style="margin-left: -12px">
      @yield('navmenu')
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
</div>
    <div class="box" style="margin-top: -20px;">
      <div class="box-header" style="margin-left: 4px">
        <h3 class="box-title col-xs-12">@yield('button')</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="margin-left: 15px; margin-right: 15px;">
        <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('scoringsheets.store') }}" method="POST">
          {{ csrf_field() }}
          @include('scorings.scoringsheets._form_setscore')
          <div class="box-footer">
              <!-- Submit Form Button -->
              {!! Form::submit('Save', ['class' => 'btn btn-xs btn-success']) !!}
              <!-- Back Button -->
              <a href="{{ route('scoringsheets.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
          </div>
        </form>
      </div>
      <!-- /.box-body -->
  </div>
</div>
@endsection

@section('scripts')
    @include('shared._part_notification')
@endsection
