<!-- Main Sidenav -->
<aside class="main-sidebar" id="main-sidenav">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        @if(empty(Auth::user()->profile->avatar))
          <img src="{{ asset('images/avatar/default.jpg') }}" class="img-circle" alt="User Image">
        @else
          <img src="/images/avatar/{{ Auth::user()->profile->avatar }}" class="img-circle" alt="User Image">
        @endif
      </div>
      <div class="pull-left info">
        <p><a href="/home/myprofile/{{ Auth::user()->name }}">{{ ucfirst(Auth::user()->name) }}</a></p>
        <a href="/home/myprofile/{{ Auth::user()->name }}"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    @include('layouts.parts.sidenav-menu')
  </section>
  <!-- /.sidebar -->
</aside>
<!-- ======= -->
