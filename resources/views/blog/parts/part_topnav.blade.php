
  <nav class="navbar navbar-static-top bg-aqua">
    <div class="container">
      <div class="navbar-header">
        <a href="{{ route('home-menu') }}" class="navbar-brand"><b>{{ config('app.name', 'Laravel') }}</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Blog <span class="sr-only">(current)</span></a></li>
          <li class="{{ Request::is('article') ? 'active' : '' }}"><a href="{{ route('article') }}">Article</a></li>
          <li class="{{ Request::is('news') ? 'active' : '' }}"><a href="{{ route('news') }}">News</a></li>
          <li class="{{ Request::is('article-news*') ? 'active' : '' }} dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Platform <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @foreach ($categories as $item)
              <li><a href="/article-news/{{strtolower($item->name)}}"><i class="fa fa-{{$item->category_icon}} fa-fw"></i>{{ $item->name }}</a></li>
              @endforeach
            </ul>
          </li>
          <li class="{{ Request::is('contact-us') ? 'active' : '' }}"><a href="{{route('contact-us')}}">Contact Us</a></li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @if (Auth::user())
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o" style="margin-top: 4px;"></i>
                <span class="label label-primary">4</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 4 messages</li>
                <li>
                  <!-- inner menu: contains the messages -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <!-- User Image -->
                          <img src="/src/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <!-- Message title and timestamp -->
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <!-- The message -->
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                  <!-- /.menu -->
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
            <!-- /.messages-menu -->
          @endif

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            @if (Auth::user())
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="/images/avatar/{{ $owner->avatar }}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ $owner->fullname }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header bg-aqua">
                  <img src="/images/avatar/{{ $owner->avatar }}" class="img-circle" alt="User Image">

                  <p>
                    {{ $owner->fullname }}
                    <small>{{ $owner->position }}</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="/home/myprofile/{{ Auth::user()->name }}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                       {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              @else
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user avatar-->
                    <img src="/src/img/avatar_default.jpg" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">Welcome Guest</span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- Menu Body -->
                    <li class="user-body">
                      <!-- Login -->
                      <form method="POST" action="{{ route('login') }}">
                          {{ csrf_field() }}
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input id="name" type="text" class="form-control" placeholder="Username" name="name" value="{{ old('name') }}">
                        </div>
                        @if ($errors->has('name'))
                          <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                          </span>
                        @endif
                        <br>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                          <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                        </div>
                        <br>
                        <div class="">
                          <button type="submit" class="btn btn-xs btn-default pull-right">Login</button>
                        </div>
                      </form>
                    </li>
              @endif
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
