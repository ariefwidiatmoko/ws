@extends('blog.blogpage')

@section('menu_nav')
  <h5 class="box-title" style="margin-left: -10px;">
    <a href="{{ route('welcome') }}">
      <span class="badge bg-aqua">
        Home Page
      </span>
    </a>
    <i style="color:aqua;" class="fa fa-angle-right fa-fw"></i>
    <a>
      <span class="badge bg-aqua">
        Contact Us
      </span>
    </a>
  </h5>
@endsection

@section('content')
<div class="col-md-6">
  <div class="fluid-container box box-solid">
    <div class="widget-user-header bg-aqua" style="padding-top:4px;padding-bottom:4px;padding-left:10px;">
      <!-- /.widget-user-image -->
      <a href="{{route('contact-us')}}" style="color: white;">
        <h4 class="widget-user-username">Contact Us</h4>
      </a>
    </div>
      <div class="box box-widget">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-12">
            <div class="col-md-12" style="text-align: center;">
              <img class="" src="/images/avatar/pcnesia.png" style="object-fit: cover; object-position: center; width: 35%; max-height: 200px; margin-bottom: 1rem;" alt="User Image"><br>
            </div>
            <div class="col-md-12" style="text-align: center;">
              <span class="username"><a href="/contact-us"><h3>Contact Us</h3></a></span>
              <p>Feel free to contact us or leave a message, we love to hear words from you.</p>
              <br>
              <br>
              <br>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4" style="text-align: center;">
                <span class="username"><i class="fa fa-street-view" style="font-size: 40px; color: #00c0ef;"></i></span>
                <br><br>
                  <span class="username"><h4 style="color: grey;">Alamat</h4></i></span>
                  <span class="username"><h5>Bojonggede, Bogor</h5></i></span>
              </div>
                <div class="col-md-4" style="text-align: center;">
                  <span class="username"><i class="fa fa-phone" style="font-size: 35px; color: #00c0ef;"></i></span>
                  <br><br>
                    <span class="username"><h4 style="color: grey;">Phone/Whatsapp</h4></i></span>
                    <span class="username"><h5>08974743477</h5></i></span>
                </div>
              <div class="col-md-4" style="text-align: center;">
                <span class="username"><i class="fa fa-envelope" style="font-size: 40px; color: #00c0ef;"></i></span>
                <br><br>
                  <span class="username"><h4 style="color: grey;">Email</h4></i></span>
                  <span class="username"><h5>ariefwidiatmoko@gmail.com</h5></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-12" style="margin-top: 80px !important;">
          @include('flash::message')
            <form enctype="multipart/form-data" role="form" action="{{ route('messages.store') }}" method="POST">
              {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group row">
                      <div class="col-md-6 @if ($errors->has('name')) has-error @endif">
                        <input name="name" class="form-control" placeholder="Your Name">
                      </div>
                      <div class="col-md-6 @if ($errors->has('email')) has-error @endif">
                        <input name="email" class="form-control" placeholder="Your Email">
                      </div>
                    </div>
                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                    <div class="form-group @if ($errors->has('title')) has-error @endif">
                      <input name="title" class="form-control" placeholder="Message Title">
                    </div>
                    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                      <textarea name="content" class="form-control" rows="5" placeholder="Your Message"></textarea>
                    </div>
                    @if ($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
                </div>
                <div class="form-group" style="text-align: center;">
                  <button type="submit" class="btn bg-aqua btn-xs">Send Message</button>
                </div>
              </form>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
</div>
@endsection
