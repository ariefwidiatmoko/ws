@extends('errors.parts._error')

@section('error_title')
  Error 404
@endsection

@section('content')

      <div class="content">
          <div class="title m-b-md">
              Resource not found - @yield('error_title')
          </div>

          <div class="links">
              <a>The requested resource could not be found.</a>
          </div>
      </div>
  </div>

@endsection
