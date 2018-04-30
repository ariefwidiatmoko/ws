@extends('blog.blogpage')

@section('menu_nav')
  <style>
    img {
            max-width: 100%;
            height: auto;
        }
  </style>

  <h5 class="box-title" style="margin-left: -10px;">
    <a href="{{ route('welcome') }}">
      <span class="badge bg-aqua">
        Home Page
      </span>
    </a>
    <i style="color:aqua;" class="fa fa-angle-right fa-fw"></i>
    <a href="/{{$item->article_news == 0 ? 'article' : 'news'}}">
      <span class="badge bg-aqua">
        {{$item->article_news == 0 ? 'Article' : 'News'}}
      </span>
    </a>
    <i style="color:aqua;" class="fa fa-angle-right fa-fw"></i>
    <a href="/article-news/{{strtolower($item->category->name)}}">
      <span class="badge bg-aqua">
        {{$item->category->name}}
      </span>
    </a>
    <i style="color:aqua;" class="fa fa-angle-right fa-fw"></i>
    <a>
      <span class="badge bg-aqua">
        Show
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
        <h4 class="widget-user-username">{{$item->category->name}} {{$item->article_news == 1 ? 'News' : 'Article'}}</h4>
      </a>
    </div>
      <div class="box box-widget">
        <div class="box-header with-border">
          <div class="user-block">
            @if (empty($item->user->profile->avatar))
              <img class="img-circle" src="/images/avatar/default.jpg" alt="User Image">
            @else
              <img class="img-circle" src="/images/avatar/{{ $item->user->profile->avatar }}" alt="User Image">
            @endif
            <span class="description">{{ $item->user->profile->fullname }} | {{ $item->published_at->diffForHumans() }} @if(Auth::user())| <a href="{{ route('posts.edit', $item->id) }}"><i class="fa fa-edit fa-fw"></i> Edit</a> @endif </span>
            <span class="username"><a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}">{{ $item->title }}</a></span>
          </div>
          <!-- /.user-block -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if (isset($item->post_thumbImage))
            <div class="col-md-12">
              <img class="img-responsive pad" src="{{ $item->post_thumbImage }}" alt="Photo">
            </div>
          @else
            <div class="col-md-12">
              <img class="img-responsive pad" src="{{ $item->post_image }}" alt="Photo">
            </div>
          @endif
          <div class="col-md-12">
            <p style="{{$item->category->name !== 'Slide' ? '' : 'margin-top: 10px;'}}">{!! $item->content !!}</p>
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
        <!-- /.box-body -->
        <div class="box-footer box-comments">
          <div class="fb-comments" data-href="https://www.pcnesia.net/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}" data-numposts="5"></div>
        </div>
      </div>
    <div style="text-align: center;">
      <span class="badge bg-aqua">Back to</span>
      <i style="color:aqua;" class="fa fa-angle-right fa-fw"></i>
      <a href="/{{strtolower($item->category->name)}}"><span class="badge bg-aqua">{{$item->category->name}}</span></a>
      <i style="color:aqua;" class="fa fa-angle-right fa-fw"></i>
      <a href="/{{$item->article_news == 1 ? 'news' : 'article'}}"><span class="badge bg-aqua">{{$item->article_news == 1 ? 'News' : 'Article'}}</span></a>
      <i style="color: aqua;" class="fa fa-angle-right fa-fw"></i>
      <a href="/"><span class="badge bg-aqua">Home</span></a>
      <br>
      <br>
    </div>
  </div>
</div>
@endsection
