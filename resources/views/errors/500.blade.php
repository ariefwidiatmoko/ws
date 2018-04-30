@extends('errors.parts._error')

@section('error_title')
  Error 500
@endsection

@section('content')

      <div class="content">
          <div class="title m-b-md">
              Webservice currently unavailable - Error 500
          </div>

          <div class="links">
              <a>An unexpected condition was encountered.</a>
          </div>
      </div>
  </div>

@endsection
