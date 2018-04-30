@extends('blog.blogpage')

@section('stylesheets')
  <style>
    #tabContent .box-body img {
      object-fit: cover;
      object-position: center;
      width: 280px;
      height: 146px;
    }
    #tabContent .box-body .row div>p {
      padding-top: 10px;
    }
  </style>
@endsection

@section('menu_nav')
  <h4 class="box-title">
    <a href="{{ route('welcome') }}">
      <span class="badge bg-aqua">
        Home Page
      </span>
    </a>
  </h4>
@endsection

@section('content')
<div class="col-md-6">
  <div class="fluid-container box box-solid">
    <!-- /.box-header -->
    <div class="box-body">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          @foreach ($slides as $item)
            <li data-target="#carousel-example-generic" data-slide-to="{{ ($item->id)-1 }}" class="{{ $item->id == 1 ? 'active' : '' }}"></li>
          @endforeach
        </ol>
        <div class="carousel-inner">
          @foreach ($slides as $item)
            <div class="item {{ $item->id == 1? 'active' : '' }}">
              <img src="images/slide/{{ $item->post_image }}" alt="@if($item->id == 1) First slide @elseif($item->id == 2) Second slide @else Third Slide @endif">

              <div class="carousel-caption">
                <div class="" style="text-shadow: 2px 4px 3px rgba(0,0,0,0.3);">
                  <h3 style="font-size: 1.4em;"><a href="/slide/{{$item->slug}}" style="color: white;">{{ $item->title }}</a> @if(Auth::user())<a href="{{ route('posts.edit', $item->id)}}"><span class="badge bg-aqua" style="font-size: 0.6em;"> Edit </span></a> @endif </h3>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
          <span class="fa fa-anglmargine-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
          <span class="fa fa-angle-right"></span>
        </a>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
    <!-- /.box -->
    <div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa fa-windows"></i></a></li>
    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-android"></i></a></li>
    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true"><i class="fa fa-apple"></i></a></li>
    <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="true"><i class="fa fa-gamepad"></i></a></li>
    <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="true"><i class="fa fa-download"></i></a></li>
  </ul>
  <div id="tabContent" class="tab-content">
    <div class="tab-pane active" id="tab_1" style="font-weight: normal;">
      @forelse ($windows as $item)
        <div class="box box-widget">
          <div class="box-header with-border">
            <div class="user-block">
              @if (empty($item->user->profile->avatar))
                <img class="img-circle" src="/images/avatar/default.jpg" alt="User Image">
              @else
                <img class="img-circle" src="/images/avatar/{{ $item->user->profile->avatar }}" alt="User Image">
              @endif
            <span class="description">{{ $item->user->profile->fullname }} | {{ $item->published_at->diffForHumans() }} @if(Auth::user())| <a href="{{ route('posts.edit', $item->id) }}"><i class="fa fa-edit fa-fw"></i> Edit</a> @endif</span>
            <span class="username"><a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}">{{ $item->title }}</a></span>
          </div>
          <!-- /.user-block -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            @if (isset($item->post_thumbImage))
              <div class="col-md-4">
                <img class="img-responsive pad" src="{{ $item->post_thumbImage }}" alt="Photo">
              </div>
            @elseif (!isset($item->post_image))
              <div class="col-md-4">
                <img class="img-responsive pad" src="http://placehold.it/600x400/3c8dbc/ffffff&amp;text=">
              </div>
            @else
              <div class="col-md-4">
                <img class="img-responsive pad" src="/images/posts/{{ $item->post_image }}" alt="Photo">
              </div>
            @endif
            <div class="col-md-8">
              <p>{!! substr($item->content, 0, random_int(300, 320)) !!}... <a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"><span class="badge bg-aqua">read more</span></a></p>
                <br>
                <div class="row" style="margin-left: 2px;">
                  <div class="fb-like" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true">
                  </div>
                  <div class="pull-right">
                    <span class="fb-comments-count" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"></span> comments
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      @empty
        No Article and News with Category {{ $item->category->name }}
      @endforelse
      @if ($windows->count() !== null )
        <a href="/windows"><span class="badge bg-aqua">View All</span></a>
      @endif
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_2" style="font-weight: normal;">
      @forelse ($android as $item)
        <div class="box box-widget">
          <div class="box-header with-border">
            <div class="user-block">
              @if (empty($item->user->profile->avatar))
                <img class="img-circle" src="/images/avatar/default.jpg" alt="User Image">
              @else
                <img class="img-circle" src="/images/avatar/{{ $item->user->profile->avatar }}" alt="User Image">
              @endif
            <span class="description">{{ $item->user->profile->fullname }} | {{ $item->published_at->diffForHumans() }} @if(Auth::user())| <a href="{{ route('posts.edit', $item->id) }}"><i class="fa fa-edit fa-fw"></i> Edit</a> @endif</span>
            <span class="username"><a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}">{{ $item->title }}</a></span>
          </div>
          <!-- /.user-block -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if (isset($item->post_thumbImage))
            <div class="col-md-4">
              <img class="img-responsive pad" src="{{ $item->post_thumbImage }}" alt="Photo">
            </div>
          @elseif (!isset($item->post_image))
            <div class="col-md-4">
              <img class="img-responsive pad" src="http://placehold.it/600x400/3c8dbc/ffffff&amp;text=">
            </div>
          @else
            <div class="col-md-4">
              <img class="img-responsive pad" src="/images/posts/{{ $item->post_image }}" alt="Photo">
            </div>
          @endif
          <div class="col-md-8">
            <p>{!! substr($item->content, 0, random_int(300, 320)) !!}... <a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"><span class="badge bg-aqua">read more</span></a></p>
              <br>
              <div class="row" style="margin-left: 2px;">
                <div class="fb-like" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true">
                </div>
                <div class="pull-right">
                  <span class="fb-comments-count" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"></span> comments
                </div>
              </div>
          </div>
        </div>
      </div>
      @empty
        No Article and News with Category {{ $item->category->name }}
      @endforelse
      @if ($android->count() !== null )
        <a href="/android"><span class="badge bg-aqua">View All</span></a>
      @endif
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_3" style="font-weight: normal;">
      @forelse ($iOs as $item)
        <div class="box box-widget">
          <div class="box-header with-border">
            <div class="user-block">
              @if (empty($item->user->profile->avatar))
                <img class="img-circle" src="/images/avatar/default.jpg" alt="User Image">
              @else
                <img class="img-circle" src="/images/avatar/{{ $item->user->profile->avatar }}" alt="User Image">
              @endif
            <span class="description">{{ $item->user->profile->fullname }} | {{ $item->published_at->diffForHumans() }} @if(Auth::user())| <a href="{{ route('posts.edit', $item->id) }}"><i class="fa fa-edit fa-fw"></i> Edit</a> @endif</span>
            <span class="username"><a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}">{{ $item->title }}</a></span>
          </div>
          <!-- /.user-block -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if (isset($item->post_thumbImage))
            <div class="col-md-4">
              <img class="img-responsive pad" src="{{ $item->post_thumbImage }}" alt="Photo">
            </div>
          @elseif (!isset($item->post_image))
            <div class="col-md-4">
              <img class="img-responsive pad" src="http://placehold.it/600x400/3c8dbc/ffffff&amp;text=">
            </div>
          @else
            <div class="col-md-4">
              <img class="img-responsive pad" src="/images/posts/{{ $item->post_image }}" alt="Photo">
            </div>
          @endif
          <div class="col-md-8">
            <p>{!! substr($item->content, 0, random_int(300, 320)) !!}... <a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"><span class="badge bg-aqua">read more</span></a></p>
              <br>
              <div class="row" style="margin-left: 2px;">
                <div class="fb-like" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true">
                </div>
                <div class="pull-right">
                  <span class="fb-comments-count" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"></span> comments
                </div>
              </div>
          </div>
        </div>
      </div>
      @empty
        No Article and News with Category {{ $item->category->name }}
      @endforelse
      @if ($iOs->count() !== null )
        <a href="/ios"><span class="badge bg-aqua">View All</span></a>
      @endif
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_4" style="font-weight: normal;">
      @forelse ($console as $item)
        <div class="box box-widget">
          <div class="box-header with-border">
            <div class="user-block">
              @if (empty($item->user->profile->avatar))
                <img class="img-circle" src="/images/avatar/default.jpg" alt="User Image">
              @else
                <img class="img-circle" src="/images/avatar/{{ $item->user->profile->avatar }}" alt="User Image">
              @endif
            <span class="description">{{ $item->user->profile->fullname }} | {{ $item->published_at->diffForHumans() }} @if(Auth::user())| <a href="{{ route('posts.edit', $item->id) }}"><i class="fa fa-edit fa-fw"></i> Edit</a> @endif</span>
            <span class="username"><a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}">{{ $item->title }}</a></span>
          </div>
          <!-- /.user-block -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if (isset($item->post_thumbImage))
            <div class="col-md-4">
              <img class="img-responsive pad" src="{{ $item->post_thumbImage }}" alt="Photo">
            </div>
          @elseif (!isset($item->post_image))
            <div class="col-md-4">
              <img class="img-responsive pad" src="http://placehold.it/600x400/3c8dbc/ffffff&amp;text=">
            </div>
          @else
            <div class="col-md-4">
              <img class="img-responsive pad" src="/images/posts/{{ $item->post_image }}" alt="Photo">
            </div>
          @endif
          <div class="col-md-8">
            <p>{!! substr($item->content, 0, random_int(300, 320)) !!}... <a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"><span class="badge bg-aqua">read more</span></a></p>
              <br>
              <div class="row" style="margin-left: 2px;">
                <div class="fb-like" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true">
                </div>
                <div class="pull-right">
                  <span class="fb-comments-count" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"></span> comments
                </div>
              </div>
          </div>
        </div>
      </div>
      @empty
        No Article and News with Category {{ $item->category->name }}
      @endforelse
      @if ($console->count() !== null )
        <a href="/console"><span class="badge bg-aqua">View All</span></a>
      @endif
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_5" style="font-weight: normal;">
      @forelse ($download as $item)
        <div class="box box-widget">
          <div class="box-header with-border">
            <div class="user-block">
              @if (empty($item->user->profile->avatar))
                <img class="img-circle" src="/images/avatar/default.jpg" alt="User Image">
              @else
                <img class="img-circle" src="/images/avatar/{{ $item->user->profile->avatar }}" alt="User Image">
              @endif
            <span class="description">{{ $item->user->profile->fullname }} | {{ $item->published_at->diffForHumans() }} @if(Auth::user())| <a href="{{ route('posts.edit', $item->id) }}"><i class="fa fa-edit fa-fw"></i> Edit</a> @endif</span>
            <span class="username"><a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}">{{ $item->title }}</a></span>
          </div>
          <!-- /.user-block -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if (isset($item->post_thumbImage))
            <div class="col-md-4">
              <img class="img-responsive pad" src="{{ $item->post_thumbImage }}" alt="Photo">
            </div>
          @elseif (!isset($item->post_image))
            <div class="col-md-4">
              <img class="img-responsive pad" src="http://placehold.it/600x400/3c8dbc/ffffff&amp;text=">
            </div>
          @else
            <div class="col-md-4">
              <img class="img-responsive pad" src="/images/posts/{{ $item->post_image }}" alt="Photo">
            </div>
          @endif
          <div class="col-md-8">
            <p>{!! substr($item->content, 0, random_int(300, 320)) !!}... <a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"><span class="badge bg-aqua">read more</span></a></p>
              <br>
              <div class="row" style="margin-left: 2px;">
                <div class="fb-like" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true">
                </div>
                <div class="pull-right">
                  <span class="fb-comments-count" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}"></span> comments
                </div>
              </div>
          </div>
        </div>
      </div>
      @empty
        No Article and News with Category {{ $item->category->name }}
      @endforelse
      @if ($download->count() !== null )
        <a href="/download"><span class="badge bg-aqua">View All</span></a>
      @endif
    </div>
    <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->
</div>
</div>
@endsection
