@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-box">
  <div class="">
    <br><br><br><br><br><br>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="box-shadow: 0 8px 6px -6px grey;">
    <h3 class="login-box-msg"><img src="../favicon.ico" style="max-width: 34px; height: auto; margin-top: -5px;" alt=""> {{ config('app.name', 'Laravel') }}</h3>
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
        <span class="fa fa-envelope form-control-feedback"></span>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

      </div>
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
        <span class=" fa fa-lock form-control-feedback"></span>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

      </div>

      <div class="form-group">
          <div>
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}  autocomplete="new-password"> Remember Me
                  </label>
              </div>
          </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-xs btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
@endsection
