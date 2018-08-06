@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('navmenu')
  <li><a href="#"><i class="fa fa-home fa-fw"></i> @yield('title')</a></li>
@endsection

@section('content')
  <div id="main-container" class="content">
    <!-- Default box -->
    <div class="col-xs-10 col-md-8">
      <div class="alert alert-info alert-dismissible" style="margin-top: 34px;">
        <button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-hidden="true">×</button>
        <h5>
          <i class="icon fa fa-bell-o"></i>
          Welcome {{ ucfirst(Auth::user()->name) }} to {{ config('app.name', 'Laravel') }} - Integrated Solution for School System.
        </h5>
      </div>
    </div>
  </div>
@endsection
