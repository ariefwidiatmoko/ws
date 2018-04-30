<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.parts.head')
@yield('stylesheets')
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="loading-page"></div>
<!-- Site wrapper -->
<div class="wrapper">
@include('layouts.parts.topnav')

@include('layouts.parts.sidenav')
  <!-- Main Content -->
  <div class="content-wrapper">
    @include('flash::message')
    @yield('content')
  </div>
  @include('layouts.parts.footer')
</div>

@include('layouts.parts.scripts')
@yield('scripts')
</body>
</html>
