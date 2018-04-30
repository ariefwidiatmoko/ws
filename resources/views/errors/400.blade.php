@extends('errors.parts._error')

@section('error_title')
  Error 400
@endsection

@section('content')

      <div class="content">
          <div class="title m-b-md">
              Bad Request - Error 400
          </div>

          <div class="links">
              <a>The server cannot process the request due to something that is perceived to be a client error.</a>
          </div>
      </div>
  </div>

@endsection
