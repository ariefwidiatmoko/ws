<html style="height: auto; min-height: 100%;">
<head>
  @include('blog.parts.part_head')
  @yield('stylesheets')
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav" style="height: auto; min-height: 100%;">
<div id="fb-root"></div>
<div class="loading-page"></div>
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <header id="header" class="main-header">
      @include('blog.parts.part_topnav')
    </header>
  <!-- Full Width Column -->
  <div class="content-wrapper" style="min-height: 832px;">
    <div class="fluid-container">
      <div class="" style="padding-left: 10px; padding-right: 10px; background-color: white;">
        <!-- Content -->
        <div class="fluid-container" style="margin-top: 48px;">
          <div class="box box-solid fluid-container">
            <div class="box-body clearfix">
              <div class="row">
                <div class="col-md-9 col-xs-6">
                  @yield('menu_nav')
                </div>
                <div class="col-md-3 col-xs-6">
                  <form action="{{ route('blogsearch') }}" method="GET">
                    <div class="input-group input-group-sm" style="margin-right: -12px;">
                      <input name="search" type="text" onfocus="this.value=''" value="{{ old('search') }}" class="form-control" placeholder="Search Here">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="row">
            @include('blog.parts.part_leftside_menu')
            @yield('content')
            @include('blog.parts.part_rightside_menu')
          </div>
        </div>
      </div>
  <!-- /.container -->
    </div>
<!-- /.content-wrapper -->
  @include('blog.parts.part_footer')
  </div>
<!-- ./wrapper -->
@include('blog.parts.part_scripts')
@include('blog.parts.tawk')
@include('blog.parts.facebookComment')
</body>
</html>
