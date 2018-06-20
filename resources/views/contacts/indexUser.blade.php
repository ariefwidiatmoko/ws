@extends('layouts.dashboard')

@section('stylesheets')
  <style>
    #inlist .box-body img {
      object-fit: cover;
      object-position: center;
      width: 150px;
      height: 150px;
    }
  </style>
@endsection

@section('title', 'User\'s Contacts')

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">Contact</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('contacts.indexUser') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Contact...">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('button')

@endsection

@section('content')
<div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
  <div class="box box-primary collapsed-box" style="margin-top: 20px;">
    <div class="box-header">
      <div class="col-md-6">
        @yield('navmenu')
      </div>
      <div class="col-md-12 row" style="margin-top: 15px;">
        <div class="col-xs-5 col-md-3 text-right">
          @yield('searchbox')
        </div>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
  </div>
    <div class="box" style="margin-top: -20px;">
      <!-- /.box-header -->
      <div id="inlist" class="table-responsive box-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="box-body no-padding">
                {{ csrf_field() }}
                <ul class="users-list clearfix hidden-xs hidden-sm">
                  @forelse ($result as $index => $item)
                    <li><button class="show-modal" style="background-color: #fff; border: none;" data-name="{{$item->name}}" data-email="{{$item->email}}" data-phone="{{$item->profile->phone}}" data-address="{{$item->profile->address}}">
                        <img src="{{ asset('images/avatar/default.jpg') }}" alt="User Image">
                      <a class="users-list-name" href="#">{{$item->name}}</a>
                      <span class="users-list-date"><b>{{$item->phone}}</b></span>
                      <span class="users-list-date"><b>{{$item->email}}</b></span></button>
                    </li>
                  @empty
                    <div style="margin-left: 10px;">No Contact</div>
                  @endforelse
                </ul>
                <!-- /.users-list -->
                <table class="table table-hover hidden-md hidden-lg">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Address</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($result as $index => $item)
                      <tr>
                        <td>{{ucwords($item->name)}}</td>
                        <td>{{$item->profile->phone}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->profile->address}}</td>
                      </tr>
                    @empty
                      <tr>
                        No Contact
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <br>
          <br>
          <div class="row">
            <div class="col-sm-5">
              <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} user's contacts )</div>
            </div>
            <div class="col-sm-7 text-right" style="margin-top: -34px;">
              {!! $result->appends(Request::all())->render() !!}
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>

  <!-- Modal Show Contact -->
  <div id="showModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header" style="background-color: #00a7d0;">
                  <div class="box widget-user-2" style="border: none">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-aqua-active" style="padding: 10px 10px 10px 10px; margin-bottom: -33px;">
                    <div class="widget-user-image">
                      <img class="img-circle" id="avatar_show" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username"><input style="background-color: #00a7d0; color: white; font-size: 1.1em; border: none;" type="text" class="form-control" id="name_show" disabled></h3>
                    <h5 class="widget-user-desc"><input style="background-color: #00a7d0; color: white; font-size: 1.2em; border: none;" type="text" class="form-control" id="phone_show" disabled></h5>
                  </div>
                </div>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal" role="form">
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Email</label>
                        <div class="col-sm-9">
                          <input style="background-color: #fff; border: none;" type="text" class="form-control" id="email_show" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="address">Address</label>
                        <div class="col-sm-9">
                          <input style="background-color: #fff; border: none;" type="text" class="form-control" id="address_show" disabled>
                        </div>
                      </div>
                  </form>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('scripts')
<script>
  // Show a post
  $(document).on('click', '.show-modal', function() {
    $('.modal-title').text('Detail Contact');
    $('#avatar_show').attr('src', $(this).find('img').attr('src'));
    $('#name_show').val($(this).data('name'));
    $('#phone_show').val($(this).data('phone'));
    $('#email_show').val($(this).data('email'));
    $('#address_show').val($(this).data('address'));
    $('#showModal').modal('show');
  });
</script>
@endsection
