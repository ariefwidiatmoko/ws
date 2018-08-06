@extends('errors.parts._error')

@section('error_title')
  Error 405
@endsection

@section('content')

      <div class="content">
          <div class="title m-b-md">
              Method is not allowed - @yield('error_title')
          </div>

          <div class="links">
              <a>Method is not allowed for the requested route.</a>
          </div>
      </div>
  </div>

@endsection
