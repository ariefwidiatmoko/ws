@extends('layouts.dashboard')

@section('title', 'Link to Employee')

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('users.index') }}">Users</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('users.index') }}" class="btn btn-xs btn-default">Back</a>
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
    <div class="box-header" style="margin-left: 16px; margin-bottom: -16px;">
      <h3 class="box-title">@yield('button')</h3>
    </div>
    <hr>
    <!-- /.box-header -->
    <div class="box-body" style="margin-left: 15px; margin-right: 15px;">
    @if(empty($user->employee))
      <form enctype="multipart/form-data" role="form" action="{{ route('users.updateLink', $user->id) }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
          <!-- user_id -->
          <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">
          <input type="hidden" name="user_id" value="{{ $user->id }}">

          <!-- Link to employee -->
          <div class="form-group">
              <label>Link "{{ucwords($user->name)}}" to Employee</label>
              <select class="form-control" name="employee_id">
                <option value="">@if(isset($user->employee)) {{$user->employee->fullname}} @else Select Employee @endif</option>
                @foreach ($employees as $item)
                  <option value="{{ $item->id }}">{{ ucwords($item->fullname) }}</option>
                @endforeach
              </select>
          </div>
          <div class="">
            <br>
            <!-- Submit Form Button -->
            {!! Form::submit('Save', ['class' => 'btn btn-xs btn-success']) !!}
            <!-- Back Button -->
            <a href="{{ route('users.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
          </div>
        </form>
      @else
        <form enctype="multipart/form-data" role="form" action="{{ route('users.deleteLink', $user->id) }}" method="POST">
          {{ method_field('PUT') }}
          {{ csrf_field() }}
          <!-- Delete Link to employee -->
          <div class="form-group">
            <label>Link {{ucwords($user->name)}}</label>
            <div class="form-control">
              <p>to <b>{{$user->employee->fullname}}</b></p>
            </div>
          </div>
          <div class="">
            <br>
            <!-- Submit Form Button -->
            {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) !!}
            <!-- Back Button -->
            <a href="{{ route('users.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
          </div>
        </form>
      @endif
    </div>
    <!-- /.box-body -->
  </div>
</div>
@endsection
