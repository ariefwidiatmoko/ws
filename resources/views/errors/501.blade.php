@extends('errors.parts._error')

@section('error_title')
  Error 501
@endsection

@section('content')

      <div class="content">
          <div class="title m-b-md">
              Not Implemented - @yield('error_title')
          </div>

          <div class="links">
              <a>The Webserver cannot recognize the request method.</a>
          </div>
      </div>
  </div>

@endsection
