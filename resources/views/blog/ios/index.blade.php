@extends('blog.blogpage')

@section('stylesheets')
  <style>
    .box-body img {
      object-fit: cover;
      object-position: center;
      width: 280px;
      height: 146px;
    }
    .box-body div>p {
      margin-top: 12px;
    }
  </style>
@endsection

@section('menu_nav')
  <h5 class="box-title" style="margin-left: -10px;">
    <a href="{{ route('welcome') }}">
      <span class="badge bg-aqua">
        Home Page
      </span>
    </a>
    <i style="color:aqua;" class="fa fa-angle-right fa-fw"></i>
    <a>
      <span class="badge bg-grey">
        iOs
      </span>
    </a>
  </h5>
@endsection

@section('content')
<div class="col-md-6">
  <div class="fluid-container box box-solid">
    <div class="widget-user-header bg-aqua" style="padding-top:4px;padding-bottom:4px;padding-left:10px;">
      <!-- /.widget-user-image -->
      <a href="/article" style="color: white;">
        <h4 class="widget-user-username">All iOs Article & News</h4>
      </a>
    </div>
    @forelse ($items as $item)
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
              <img class="img-responsive pad" src="{{ $item->post_image }}" alt="Photo">
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
    <div style="text-align: center;">
      {!! $items->appends(Request::all())->render() !!}
    </div>
  </div>
</div>
@endsection
