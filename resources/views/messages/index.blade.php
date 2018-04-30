@extends('layouts.dashboard')

@section('title', 'Messages')

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('messages.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Message...">
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
      <div class="box-header" style="margin-left: 16px;">
        <h3 class="box-title">@yield('button')</h3>
      </div>
      <!-- /.box-header -->
      <div id="inlist" class="table-responsive box-body">
          <div class="row">
            <div class="col-sm-12">
              <table id="inlist" class="table table-hover">
                <thead>
                      <th style="text-align: center;">No</th>
                      <th style="text-align: center;">Name</th>
                      <th style="text-align: center;">Email</th>
                      <th style="text-align: center;">Title</th>
                      <th style="text-align: center;">Content</th>
                      <th style="text-align: center;">Date</th>
                      <th style="text-align: center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse ($result as $index => $item)
                    <tr>
                      <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                      <td style="text-align: center;">{{ ucfirst($item->name) }}</td>
                      <td style="text-align: center;">{{ $item->email }}</td>
                      <td style="text-align: center;">{{ $item->title }}</td>
                      <td style="text-align: center;">{{ substr($item->content, 0, random_int(200, 250)) }}...</td>
                      <td style="text-align: center;">{{ $item->created_at->diffForHumans() }}</td>
                      <td>


                          <div class="row">
                            <div class="btn-group" role="group">
                              <div class="col-xs-1 margin">
                                  <a href="{{ route('messages.show', $item->id) }}" class="btn btn-xs btn-info">View</a>
                              </div>
                              <div class="col-xs-1 margin">
                                  @can('delete_messages')
                                    {!! Form::open( ['method' => 'delete', 'url' => route('messages.destroy', $item->id), 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
                                      <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                    {!! Form::close() !!}
                                  @endcan
                              </div>
                            </div>
                          </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td>No Message</td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} messages )</div>
              </div>
              <div class="col-sm-7 text-right" style="margin-top: -34px;">
                {!! $result->appends(Request::all())->render() !!}
              </div>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
@endsection
