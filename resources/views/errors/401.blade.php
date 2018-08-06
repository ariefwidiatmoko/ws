@extends('errors.parts._error')

@section('error_title')
  Error 401
@endsection

@section('content')

      <div class="content">
          <div class="title m-b-md">
              Unauthorized - @yield('error_title')
          </div>

          <div class="links">
              <a>The requested resource requires an authentication.</a>
          </div>
      </div>
  </div>

@endsection
