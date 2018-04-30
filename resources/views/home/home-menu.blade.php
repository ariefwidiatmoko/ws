<html style="height: auto; min-height: 100%;">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/src/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/src/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/src/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/src/css/AdminLTE.min.css">
  <!-- AdminLTE Skins-->
  <link rel="stylesheet" href="/src/css/skins/_all-skins.min.css">
  <!-- Loading Page-->
  <link rel="stylesheet" href="/src/css/loading-page.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav" style="height: auto; min-height: 100%;">
<div class="loading-page"></div>
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="/" class="navbar-brand"><b>{{ config('app.name', 'Laravel') }}</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Welcome page <span class="sr-only">(current)</span></a></li>
              <li><a href="{{route('welcome')}}">Blog</a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">School-site <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{route('school-site1')}}"><i class="fa fa-caret-right fa-fw"></i>School One</a></li>
                  <li><a href="{{route('school-site2')}}"><i class="fa fa-caret-right fa-fw"></i>School Two</a></li>
                </ul>
              </li>
              <li><a href="{{route('profile-site')}}">Profile</a></li>
              <li><a href="{{route('store-site')}}">Store</a></li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
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

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="/src/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="/src/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                      </div>
                    </div>
                    <!-- /.row -->
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>
  <!-- Full Width Column -->
  <div class="content-wrapper" style="min-height: 832px;">
    <div class="fluid-container">
      <div class="" style="padding-left: 10px; padding-right: 10px; background-color: white;">
        <!-- Content -->
        <div style="min-height: 100%; min-height: 89vh; display: flex; align-items: center; margin-left: 40px; margin-right: 40px;">
          <div class="container">
            <div class="col-md-12">
              <h2 style="text-align: center; margin-bottom: 60px;"><a href="/"><i class="fa fa-home fa-fw"></i>Welcome page</a></h2>
            </div>
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="{{route('welcome')}}">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-opera" style="font-size: 60px; color: white; margin-top: 15px;"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-number">Blog</span>
                      <span class="info-box-text">Site</span>
                    </div>
                  <!-- /.info-box-content -->
                  </div>
                <!-- /.info-box -->
                </a>
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">

                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-users" style="font-size: 60px; color: white; margin-top: 15px;"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number">School</span>
                    <span class="info-box-text"><a href="{{route('school-site1')}}">Site1</a></span>
                    <span class="info-box-text"><a href="{{route('school-site2')}}">Site2</a></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <!-- fix for small devices only -->
              <div class="clearfix visible-sm-block"></div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="/profile-site">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-user" style="font-size: 60px; color: white; margin-top: 15px;"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number">Profile</span>
                    <span class="info-box-text">Site</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="/store-site">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-cart-plus" style="font-size: 60px; color: white; margin-top: 15px;"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number">Store</span>
                    <span class="info-box-text">Site</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <!-- /.col -->
            </div>
          </div>
        </div>
        <!-- /.container -->
      </div>
      <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="container" style="text-align:center;">
        <strong>Copyright © 2018 <a href="#">{{ config('app.name', 'Laravel') }}</a>.</strong> All rights
        reserved.
      </div>
      <!-- /.container -->
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="/src/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="/src/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="/src/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="/src/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="/src/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/src/js/demo.js"></script>
  <script type="text/javascript">
    //Loading Dasboard
    $( window ).on( "load", function() {
        $(".loading-page").fadeOut("slow");
    });
  </script>


</body>
</html>
