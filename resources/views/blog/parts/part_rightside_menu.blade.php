
<div class="col-md-3">
<div class="box box-solid">
  <div class="box-header bg-aqua">
    <h3 class="box-title">Subscribe Article & News</h3>

    <div class="box-tools pull-right">
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body bg-aqua">
    <form enctype="multipart/form-data" role="form" action="{{ route('messages.subscribe') }}" method="POST">
      {{ csrf_field() }}
      <div class="input-group">
        <input name="email" value="" type="text" class="form-control">
        <span class="input-group-btn">
          <button type="submit" class="btn bg-aqua btn-flat">Send</button>
        </span>
      </div>
      <input type="hidden" name="content" value="subscribe article & news">
      <input type="hidden" name="name" value="guest">
      <input type="hidden" name="title" value="subscribe">
    </form>
  </div>
  @include('flash::message')
  <!-- /.box-body -->
</div>
<!-- /.box -->

<div class="box box-solid hidden-xs" style="border-color: white;">
  <div class="box-header with-border bg-aqua">
    <h3 class="box-title" style="color: white;">Latest Articles</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" style="color: white; margin-top: 4px;"></i>
      </button>
    </div>
  </div>
    <!-- /.box-header -->
  <div class="box-body">
    <ul class="products-list product-list-in-box">
      @foreach ($article as $item)
        <li class="item">
          <div class="product-img">
            @if(isset($item->post_thumbImage))
              <img src="{{$item->post_thumbImage}}" style="object-fit: cover; object-position: center; width: 50px; max-height: 50px; margin-bottom: 1rem;" alt="User Image" alt="Product Image">
            @else
              <img src="/src/img/default-50x50.gif" alt="Product Image">
            @endif
          </div>
          <div class="product-info">
            <a href="/article-news/{{strtolower($item->category->name)}}" class="product-title">{{ $item->category->name }}</a>
            <span class="product-description">
              <a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}">{{ $item->title }}</a>
            </span>
          </div>
        </li>
        <!-- /.item -->
      @endforeach
    </ul>
  </div>
  <!-- /.box-body -->
  <div class="box-footer text-center">
    <a href="/article" class="uppercase">View All Articles</a>
  </div>
  <!-- /.box-footer -->
</div>
</div>
