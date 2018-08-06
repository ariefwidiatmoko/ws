@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('stylesheets')
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('src/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> }}">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a>User Managements</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('profiles.index') }}" class="btn btn-xs btn-default">Back</a>
@endsection

@section('content')
  <div class="content" id="main-content" style="margin-top: -40px; margin-left: 1px;">
    <div class="box box-primary collapsed-box" style="margin-top: 20px;">
      <div class="box-header">
        <div class="col-md-6">
          @yield('navmenu')
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
    </div>
    <div class="row" style="margin-top: -20px;">
    <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-default">
              <div class="box-header" style="margin-left: 16px; margin-bottom: -22px;">
                <h3 class="box-title">@yield('button')</h3>
              </div>
              <hr>
              <div class="box-body box-profile">
                @if(empty(Auth::user()->profile->avatar))
                  <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/avatar/default.jpg') }}" alt="User profile picture">
                @else
                  <img class="profile-user-img img-responsive img-circle" src="/images/avatar/{{ Auth::user()->profile->avatar }}" alt="User profile picture">
                @endif
                <h3 class="profile-username text-center">{{ ucfirst(Auth::user()->name) }}</h3>
                <p class="text-muted text-center">
                  @if(empty(Auth::user()->profile->fullname))

                  @else
                    {{ ucfirst(Auth::user()->profile->fullname) }} /
                  @endif
                  @if(empty(Auth::user()->profile->dob))

                  @else
                    {{ Auth::user()->profile->dob->age }} years old
                  @endif</p>
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item clearfix">
                    <b>Email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                  </li>
                  <li class="list-group-item clearfix">
                    <b>Date of Birth</b> <a class="pull-right">{{ Auth::user()->profile->dob->toFormattedDateString() }}</a>
                  </li>
                  <li class="list-group-item clearfix">
                    <b>Phone</b> <a class="pull-right">{{ Auth::user()->profile->phone }}</a>
                  </li>
                </ul>
                <a id="btnEditP" href="#editProfile1" data-toggle="tab" class="btn btn-block bg-aqua"><b>Edit Profile</b></a>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- About Me Box -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                <p class="text-muted">
                  {{ Auth::user()->profile->education }}
                </p>
                <hr>
                <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                <p class="text-muted">{{ Auth::user()->profile->address }}</p>
                <hr>
                @if(isset(Auth::user()->employee->positions))
                <strong><i class="fa fa-pencil margin-r-5"></i> Position</strong>
                <p>
                  @foreach (Auth::user()->employee->positions as $item)
                  <span class="label label-info">{{$item->name}}</span>
                  @endforeach
                </p>
                <hr>
                @else

                @endif
                <strong><i class="fa fa-file-text-o margin-r-5"></i> About</strong>
                <p>{{ Auth::user()->profile->about }}</p>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class=""><a href="#activity" data-toggle="tab" aria-expanded="false">Activity</a></li>
                <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="true">Timeline</a></li>
                <li class="active tab-pane" id="editProfile"><a href="#editProfile1" data-toggle="tab" aria-expanded="false">Edit Profile</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane" id="activity">
                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="/src/img/user1-128x128.jpg" alt="user image">
                          <span class="username">
                            <a href="#">Jonathan Burke Jr.</a>
                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                          </span>
                      <span class="description">Shared publicly - 7:30 PM today</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      Lorem ipsum represents a long-held tradition for designers,
                      typographers and the like. Some people hate it and argue for
                      its demise, but others ignore the hate as they create awesome
                      tools to help create filler text for everyone from bacon lovers
                      to Charlie Sheen fans.
                    </p>
                    <ul class="list-inline">
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                      </li>
                      <li class="pull-right">
                        <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                          (5)</a></li>
                    </ul>
                    <input class="form-control input-sm" type="text" placeholder="Type a comment">
                  </div>
                  <!-- /.post -->
                  <!-- Post -->
                  <div class="post clearfix">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="/src/img/user7-128x128.jpg" alt="User Image">
                          <span class="username">
                            <a href="#">Sarah Ross</a>
                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                          </span>
                      <span class="description">Sent you a message - 3 days ago</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      Lorem ipsum represents a long-held tradition for designers,
                      typographers and the like. Some people hate it and argue for
                      its demise, but others ignore the hate as they create awesome
                      tools to help create filler text for everyone from bacon lovers
                      to Charlie Sheen fans.
                    </p>
                    <form class="form-horizontal">
                      <div class="form-group margin-bottom-none">
                        <div class="col-sm-9">
                          <input class="form-control input-sm" placeholder="Response">
                        </div>
                        <div class="col-sm-3">
                          <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.post -->
                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="/src/img/user6-128x128.jpg" alt="User Image">
                          <span class="username">
                            <a href="#">Adam Jones</a>
                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                          </span>
                      <span class="description">Posted 5 photos - 5 days ago</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="row margin-bottom">
                      <div class="col-sm-6">
                        <img class="img-responsive" src="/src/img/photo1.png" alt="Photo">
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-6">
                        <div class="row">
                          <div class="col-sm-6">
                            <img class="img-responsive" src="/src/img/photo2.png" alt="Photo">
                            <br>
                            <img class="img-responsive" src="/src/img/photo3.jpg" alt="Photo">
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-6">
                            <img class="img-responsive" src="/src/img/photo4.jpg" alt="Photo">
                            <br>
                            <img class="img-responsive" src="/src/img/photo1.png" alt="Photo">
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <ul class="list-inline">
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                      </li>
                      <li class="pull-right">
                        <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                          (5)</a></li>
                    </ul>
                    <input class="form-control input-sm" type="text" placeholder="Type a comment">
                  </div>
                  <!-- /.post -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                  <!-- The timeline -->
                  <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <li class="time-label">
                          <span class="bg-red">
                            10 Feb. 2014
                          </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-envelope bg-blue"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                        <div class="timeline-body">
                          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                          weebly ning heekya handango imeem plugg dopplr jibjab, movity
                          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                          quora plaxo ideeli hulu weebly balihoo...
                        </div>
                        <div class="timeline-footer">
                          <a class="btn btn-primary btn-xs">Read more</a>
                          <a class="btn btn-danger btn-xs">Delete</a>
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-user bg-aqua"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                        </h3>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-comments bg-yellow"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                        <div class="timeline-body">
                          Take me to your leader!
                          Switzerland is small and neutral!
                          We are more like Germany, ambitious and misunderstood!
                        </div>
                        <div class="timeline-footer">
                          <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <li class="time-label">
                          <span class="bg-green">
                            3 Jan. 2014
                          </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-camera bg-purple"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                        <div class="timeline-body">
                          Take me to your leader!
                          Switzerland is small and neutral!
                          We are more like Germany, ambitious and misunderstood!
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <li>
                      <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                  </ul>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="editProfile1">
                  <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('profiles.update', Auth::user()->profile->id) }}" method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input value="{{ Auth::user()->name }}" type="text" class="form-control" name="name" id="inputName" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input value="{{ Auth::user()->email }}" name="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Fullname</label>
                      <div class="col-sm-10">
                        <input value="{{ Auth::user()->profile->profilename }}" name="profilename" type="text" class="form-control" id="inputName" placeholder="Fullname">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputDob" class="col-sm-2 control-label">Date of Birth</label>
                      <div class="col-sm-10">
                        <input data-date-format="yyyy-mm-dd" value="{{ Auth::user()->profile->dob ? Auth::user()->profile->dob->format('Y-m-d') : null }}" name="dob" type="text" class="form-control" id="datepicker">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEducation" class="col-sm-2 control-label">Education</label>
                      <div class="col-sm-10">
                        <input value="{{ Auth::user()->profile->education }}" name="education" type="text" class="form-control" placeholder="Education">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Phone</label>
                      <div class="col-sm-10">
                        <input value="{{ Auth::user()->profile->phone }}" name="phone" type="text" class="form-control" placeholder="Phone">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                      <div class="col-sm-10">
                        <input value="{{ Auth::user()->profile->address }}" name="address" type="text" class="form-control" placeholder="Address">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">About</label>
                      <div class="col-sm-10">
                        <textarea name="about" class="form-control" placeholder="About">{{ Auth::user()->profile->about }}</textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" style="margin-top: -6px;">Avatar</label>
                      <div class="col-sm-10">
                        <input type="file" name="profile_avatar" value="" placeholder="Avatar">
                      </div>
                    </div>
                    <hr>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <!-- Submit Form Button -->
                        {!! Form::submit('Update', ['class' => 'btn btn-success btn-xs']) !!}
                      </div>
                    </div>
                  </form>
                  <br>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
@endsection

@section('scripts')
  <script src="{{ asset('src/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"type="text/javascript"></script>
  <script>
  $(function() {
    $('#btnEditP').bind('click', function() {
      $('ul.nav li.active').removeClass('active');
      $('ul.nav li.tab-pane').addClass('active');
      });
    $('#datepicker').datepicker({
      autoclose: true
    });
  });
  </script>
@endsection
