@extends('layouts.dashboard')

@section('title', 'Change Password')

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('myprofile.show', $user->name) }}">Users</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('home') }}" class="btn btn-xs btn-default">Back</a>
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
      <form enctype="multipart/form-data" role="form" action="{{ route('users.updatePassword', $user->id) }}" method="POST">
          {{ method_field('PUT') }}
          {{ csrf_field() }}
          
          <!-- Username -->
          <div class="form-group @if ($errors->has('name')) has-error @endif">
              <label>Username</label>
              <input type="text" class="form-control" name="name" value="{{ $user->email }}" disabled>
          </div>

          <!-- Password -->
          <div class="form-group @if ($errors->has('alias')) has-error @endif">
              <label>Change Password</label>
              <input value="" id="password" name="password" type="password" class="form-control" id="inputPassword" placeholder="New Password" required>
          </div>
        <div class="">
          <br>
          <!-- Submit Form Button -->
          {!! Form::submit('Save', ['class' => 'btn btn-xs btn-success']) !!}
          <!-- Back Button -->
          <a href="{{ route('home') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
</div>
@endsection
