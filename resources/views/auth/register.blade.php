@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('login') }}"><img src="../favicon.ico" style="max-width: 34px; height: auto; margin-top: -5px;" alt=""> {{ config('app.name', 'Laravel') }}</a>
  </div>
  <div class="help-block text-center">
    REGISTRATION: Please contact the administrator
  </div>
  <div class="text-center">
    <a href="{{ route('welcome') }}">Or back to Home page...</a>
  </div>
</div>
@endsection
