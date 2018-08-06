@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('stylesheets')
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('src/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> }}">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a>User Managements</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('profiles.index') }}">Profiles</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('profiles.index') }}" class="btn btn-xs btn-default">Back</a>
@endsection

@section('content')
  <div class="content" id="main-content" style="margin-top: -40px; margin-left: 1px;">
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
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="box box-default">
        <div class="box-header" style="margin-left: 16px; margin-bottom: -18px;">
          <h3 class="box-title">@yield('button')</h3>
        </div>
        <hr>
        <div class="box-body box-profile">
          @if(empty($profile->avatar))
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/avatar/default.jpg') }}" alt="User profile picture">
          @else
            <img class="profile-user-img img-responsive img-circle" src="/images/avatar/{{ $profile->avatar }}" alt="User profile picture">
          @endif
          <h3 class="profile-username text-center">{{ ucfirst($profile->user->name) }}</h3>
          <p class="text-muted text-center">
            @if(empty($profile->fullname))
              -
            @else
              {{ ucfirst($profile->fullname) }}
            @endif</p>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item clearfix"><b>
              Email</b><a class="pull-right">{{ $profile->user->email }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Date of Birth</b><a class="pull-right">{{ $profile->dob != null ? $profile->dob->format('d M Y') : '' }}</a>
            </li>
            <li class="list-group-item clearfix"><b>
              Age</b><a class="pull-right">{{ $profile->dob != null ? $profile->dob->age : '' }} years old</a>
            </li>
          </ul>
          <b>Phone</b><a class="pull-right">{{ $profile->phone }}</a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- About Me Box -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">About Me</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body"><strong><i class="fa fa-book margin-r-5"></i>
          Education</strong>
          <p class="text-muted">
            {{ $profile->education }}
          </p>
          <hr>
          <strong><i class="fa fa-map-marker margin-r-5"></i>
          Address</strong>
          <p class="text-muted">{{ $profile->address }}</p>
          <hr>
          <strong><i class="fa fa-pencil margin-r-5"></i>
          Skills</strong>
          <p>
            <span class="label label-danger">UI Design</span>
            <span class="label label-success">Coding</span>
            <span class="label label-info">Javascript</span>
            <span class="label label-warning">PHP</span>
            <span class="label label-primary">Node.js</span>
          </p>
          <hr>
          <strong><i class="fa fa-file-text-o margin-r-5"></i>
          About</strong>
          <p>{{ $profile->about }}</p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-default">
        <ul class="nav nav-tabs">
          <li><a data-toggle="tab" aria-expanded="false" style="color: black; font-weight: bold; font-size: 16px; pointer-events: none;">Edit Profile</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" style="margin: 15px;">
            <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('profiles.update', $profile->id) }}" method="POST">
              {{ method_field('PUT') }}
              {{ csrf_field() }}
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">
                  Username
                </label>
                <div class="col-sm-10">
                  <input value="{{ $profile->user->name }}" type="text" class="form-control" name="name" id="inputName">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">
                  Email
                </label>
                <div class="col-sm-10">
                  <input value="{{ $profile->user->email }}" name="email" type="email" class="form-control" id="inputEmail">
                </div>
              </div>
              <div class="form-group">
                <label for="input Name" class="col-sm-2 control-label">
                Fullname
                </label>
                <div class="col-sm-10">
                  <input value="{{ $profile->profilename }}" name="profilename" type="text" class="form-control" id="inputName">
                </div>
              </div>
              <div class="form-group">
                <label for="inputDob" class="col-sm-2 control-label">
                  Date of Birth
                </label>
                <div class="col-sm-10">
                  <input data-date-format="yyyy-mm-dd" value="{{ $profile->dob ? $profile->dob->format('Y-m-d') : null }}" name="dob" type="text" class="form-control" id="datepicker" placeholder="Date of Birth">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEducation" class="col-sm-2 control-label">
                  Education
                </label>
                <div class="col-sm-10">
                  <input value="{{ $profile->education }}" name="education" type="text" class="form-control" id="inputEducation" placeholder="Education">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPhone" class="col-sm-2 control-label">
                  Phone
                </label>
                <div class="col-sm-10">
                  <input value="{{ $profile->phone }}" name="phone" type="text" class="form-control" id="inputPhone" placeholder="Phone">
                </div>
              </div>
              <div class="form-group">
                <label for="inputAddress" class="col-sm-2 control-label">
                  Address
                </label>
                <div class="col-sm-10">
                  <input value="{{ $profile->address }}" name="address" type="text" class="form-control" id="inputAddress" placeholder="Address">
                </div>
              </div>
              <div class="form-group">
                <label for="inputAbout" class="col-sm-2 control-label">
                  About
                </label>
                <div class="col-sm-10">
                  <textarea name="About" class="form-control" rows="5" id="inputAbout" placeholder="About">{{ $profile->about }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputAvatar" class="col-sm-2 control-label">
                  Avatar
                </label>
                <div class="col-sm-10">
                  <input type="file" name="profile_avatar" value="" class="form-control" id="inputAvatar" placeholder="Avatar">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">
                  Reset Password
                </label>
                <div class="col-sm-10">
                  <input value="" id="password" name="password" type="password" class="form-control" id="inputPassword" placeholder="Reset Password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <!-- Submit Form Button -->
                  {!! Form::submit('Save', ['class' => 'btn btn-success btn-xs']) !!}
                  <a href="{{ route('profiles.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
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
    <script src="{{ asset('src/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"type="text/javascript"></script>
    <script>
      $(function() {
        $('#datepicker').datepicker({
          autoclose: true
        });
      });
    </script>
@endsection
