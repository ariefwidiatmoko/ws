@extends('errors.parts._error')

@section('error_title')
  Error 422
@endsection

@section('content')

      <div class="content">
          <div class="title m-b-md">
              Something is missing - @yield('error_title')
          </div>

          <div class="links">
              <a>Please contact the administrator to solve this problem.</a>
          </div>
      </div>
  </div>

@endsection
