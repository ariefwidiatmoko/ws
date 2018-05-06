@extends('layouts.dashboard')

@section('title', 'View Note')

@section('stylesheets')
  <style>
      img {
              max-width: 100%;
              height: auto;
          }
      .box-body img
          {
              object-fit: cover;
              object-position: center;
              width: 600px;
          }
  </style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('notes.index') }}">Notes</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')
  <a href="{{ route('notes.index') }}" class="btn btn-xs btn-default">Back</a>
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
      <div class="user-block" style="margin-left: 28px; margin-top: -10px;">
        @if (empty($note->user->profile->avatar))
          <img class="img-circle" src="{{ asset('images/avatar/default.jpg') }}" alt="User Image">
        @else
          <img class="img-circle" src="/images/avatar/{{ $note->user->profile->avatar }}" alt="User Image">
        @endif
        <span class="username"><a href="#">{{ ucfirst($note->user->name) }}</a></span>
        <span class="description">Update at: {{ $note->updated_at->diffForHumans() }} / {{ $note->created_at->format('d M Y') }}</span>
        <div class="username">
          <span class="label label-danger">Updated by : {{ $note->updated_by == null ? ucfirst($note->user->name) : ucfirst($note->updated_by) }}</span>
          <span class="label label-warning">Segment : {{ ucfirst($note->notesegment) }}</span>
          {!! $note->noteactive == 1 ? '<span class="label label-success">Publish : Yes</span>' : '<span class="label bg-gray">Publish : No</span>' !!}
        </div>
      </div>
      <div class="box-body" style="margin-left: 10px; margin-right: 10px;">
        <div style="margin-left: -10px;">
          <br>
          <h4><b style="color: white; background-color: #0091EA; margin: 15px 15px 15px 15px; padding: 10px 60px 10px 60px; box-shadow: 0 8px 6px -6px grey;">{{ ucwords($note->notetitle) }}</b></h4>
          <br>
          @if(isset($note->image))
            <div class="col-md-4">
              <img class="img-responsive img-thumbnail" src="/images/notes/{{ $note->image }}" alt="Image">
              <p style="font-style: italic;">Image Thumbnail</p>
            </div>
          @endif
        </div>
        <div class="col-md-12" style="margin: 10px 0px 0px -10px;">
          <p>{!! $note->description !!}</p>
          <div class="box-footer" style="margin-left: -10px;">
              <div class="margin">
                <div class="btn-group">
                  @can ('edit_notes', $note)
                    <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-info btn-xs">Edit</a>
                  @endcan
                </div>
                <div class="btn-group">
                  @can ('delete_notes', $note)
                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Do you want to delete this item?')">
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
