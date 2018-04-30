@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('navmenu')
  <li><a href="#"><i class="fa fa-home fa-fw"></i> @yield('title')</a></li>
@endsection

@section('content')
  <div id="main-container" class="content">
    <div class="col-md-12" style="margin-top: 25px;">
      <iframe src="/filemanager" style="width: 100%; height: 780px; overflow: hidden; border: none;"></iframe>
    </div>
  </div>
@endsection
