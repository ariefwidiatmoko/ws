<!-- Main Navbar -->
<header class="main-header" id="main-navbar">
<!-- Logo -->
<a href="{{ url('/') }}" class="logo" style="background-color: #3c8dbc;">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img src="/favicon.ico" style="max-width: 38px; height: auto;" alt=""></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><img src="/favicon.ico" style="max-width: 24px; height: auto; margin-top: -5px;" alt=""> {{ config('app.name', 'Laravel') }}</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      @if (Auth::guest())
          <li><a href="{{ route('login') }}"><i class="fa fa-sign-in fa-fw"></i> Login</a></li>
      @else
      <!-- Messages -->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="/src/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(empty(Auth::user()->profile->avatar))
                <img src="{{ asset('images/avatar/default.jpg') }}" class="user-image" alt="User Image">
              @else
                <img src="/images/avatar/{{ Auth::user()->profile->avatar }}" class="user-image" alt="User Image">
              @endif
              <span class="hidden-xs">{{ ucfirst(Auth::user()->name) }} | {{ Auth::user()->roles->pluck('name')->first() }} </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(empty(Auth::user()->profile->avatar))
                  <img src="{{ asset('images/avatar/default.jpg') }}" class="img-circle" alt="User Image">
                @else
                  <img src="/images/avatar/{{ Auth::user()->profile->avatar }}" class="img-circle" alt="User Image">
                @endif
                <p>
                  {{ ucfirst(Auth::user()->name) }} - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/home/myprofile/{{ Auth::user()->name }}" class="btn btn-default btn-flat"><i class="fa fa-user fa-fw"></i>Profile</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</span></a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         {{ csrf_field() }}
                      </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Logout Button -->
          <li>
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
                </form>
          </li>
        @endif
    </ul>
  </div>
</nav>
</header>
