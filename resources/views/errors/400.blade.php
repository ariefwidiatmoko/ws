@extends('errors.parts._error')

@section('error_title')
  Error 400
@endsection

@section('content')

      <div class="content">
          <div class="title m-b-md">
              Bad Request - @yield('error_title')
          </div>

          <div class="links">
              <a>The server cannot process the request due to something that is perceived to be a client error.</a><br>
              <p>{!!$message!!}</p>
          </div>
      </div>
  </div>

@endsection
