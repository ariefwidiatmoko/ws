@extends('layouts.dashboard')

@section('title', 'View Lesson')

@section('stylesheets')
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/src/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <style>
      img {
              max-width: 100%;
              height: auto;
          }
  </style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Contents</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('lessons.index') }}">Posts</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')
  <a href="{{ route('lessons.index') }}" class="btn btn-xs btn-default">Back</a>
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
      <div class="box-header" style="margin-bottom: -18px; margin-left: 16px;">
        <h3 class="box-title">@yield('button')</h3>
      </div>
      <hr>
      <div class="user-block" style="margin-left: 28px; margin-top: -10px; margin-bottom: -16px;">
        @if (empty($lesson->user->profile->avatar))
        <img class="img-circle" src="{{ asset('images/avatar/default.jpg') }}" alt="User Image">
        @else
        <img class="img-circle" src="/images/avatar/{{ $lesson->user->profile->avatar }}" alt="User Image">
        @endif
        <span class="username"><a href="#">{{ ucfirst($lesson->user->name) }}</a></span>
        <span class="description">Update at: {{ $lesson->updated_at->diffForHumans() }} | Create at: {{ $lesson->created_at->format('d M Y') }}</span>
        <div class="username">
          <span class="label label-primary">Updated by : {{ $lesson->updated_by == null ? ucfirst($lesson->user->name) : ucfirst($lesson->updated_by) }}</span>
          <span class="label label-warning">Subject : {{ ucfirst($lesson->subject->subjectname) . ' - ' . ucfirst($lesson->subject->alias) }}</span>
          <span class="label bg-green">Publish : {{$lesson->lessonactive ? 'Yes' : 'No'}}</span>
        </div>
      </div>
      <hr>
      <div class="box-body" style="margin-left: 10px; margin-right: 10px; margin-top: -15px;">
        <div style="margin-left: -10px;">
          <h4><b style="color: white; background-color: #0091EA; margin: 15px 15px 15px 15px; padding: 10px 60px 10px 60px; box-shadow: 0 8px 6px -6px grey;">{{ ucwords($lesson->lessontitle) }}</b></h4>
          <div class="col-md-8" style="margin-top: 20px;">
            <p>{!! $lesson->lessoncontent !!}</p>
            <div class="box-footer" style="margin-left: -20px;">
              <div class="margin">
                <div class="btn-group">
                  @can ('edit_lessons', $lesson)
                    <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-info btn-xs">Edit</a>
                  @endcan
                </div>
                <div class="btn-group">
                  @can ('delete_lessons', $lesson)
                    <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Do you want to delete {{$lesson->lessontitle}}?')">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                    </form>
                  @endcan
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <!-- /.user-block -->
    </div>
    <!-- /.box-header -->
</div>
@endsection

@section('scripts')
    <!-- toastr notifications -->
    <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>
    @include('shared._part_notification')
@endsection
