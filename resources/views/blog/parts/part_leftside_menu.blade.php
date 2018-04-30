  <div class="col-md-3">
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-aqua">
        <div class="widget-user-image">
          <img class="img-circle" src="/images/avatar/pcnesia.png" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <a href="{{ route('welcome') }}" style="color: white;">
          <h3 class="widget-user-username">PCnesia</h3>
          <h5 class="widget-user-desc">PCNATION FOR PC ENTHUSIAST</h5>
        </a>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          @foreach ($categories as $item)
            <li>
              <a href="/article-news/{{strtolower($item->name)}}"><i class="fa fa-{{$item->category_icon}} fa-fw"></i> {{ $item->name }} <span class="pull-right badge bg-aqua"></span></a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="box box-solid hidden-xs">
      <div class="box-header with-border bg-aqua">
        <h3 class="box-title" style="color: white;">Latest News</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" style="color: white; margin-top: 4px;"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <ul class="products-list product-list-in-box">
          @foreach ($news as $item)
            <li class="item">
              <div class="product-img">
                @if(isset($item->post_thumbImage))
                  <img src="{{$item->post_thumbImage}}" style="object-fit: cover; object-position: center; width: 50px; max-height: 50px; margin-bottom: 1rem;" alt="User Image" alt="Product Image">
                @else
                  <img src="/src/img/default-50x50.gif" alt="Product Image">
                @endif
              </div>
              <div class="product-info">
                <a href="/article-news/{{ strtolower($item->category->name) }}" class="product-title">{{ $item->category->name }}</a>
                <span class="product-description">
                      <a href="/article-news/{{strtolower($item->category->name)}}/{{$item->slug}}">{{ $item->title }}</a>
                    </span>
              </div>
            </li>
          @endforeach
          <!-- /.item -->
        </ul>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <a href="/news" class="uppercase">View All News</a>
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
