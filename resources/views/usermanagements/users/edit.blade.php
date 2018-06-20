@extends('layouts.dashboard')

@section('title', 'Edit User')

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
      <form role="form" action="{{ route('users.update', $user->id) }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
      @include('usermanagements.users._form_edit')
      <!-- Permissions -->
      @if(isset($user))
        @include('usermanagements.users._form_edit_permissions', ['model' => $user ])
      @endif

      <!-- Link Password -->
      <div class="form-group @if ($errors->has('password')) has-error @endif">
        <label><a class="btn btn-xs btn-danger" href="{{route('users.changePassword', $user->id)}}">Change Password</a></label>
      </div>

      <div class="box-footer">
        <!-- Submit Form Button -->
        {!! Form::submit('Save', ['class' => 'btn btn-xs btn-success']) !!}
        <!-- Back Button -->
        <a href="{{ route('users.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
      </div>
    </form>
  </div>
  <!-- /.box-body -->
</div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/app.js')}}"></script>
@endsection
