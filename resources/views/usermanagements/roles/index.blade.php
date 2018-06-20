@extends('layouts.dashboard')

@section('title', 'Roles')

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('roles.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Roles...">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('button')
  @can('add_categories')
  <a href="{{ route('roles.create') }}" class="btn btn-xs btn-success">New Role</a>
  @endcan
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
                      <th style="text-align: center;">Guard name</th>
                      <th style="text-align: center;">Created At</th>
                      <th style="text-align: center;">Updated At</th>
                      @can ('edit_roles')
                      <th style="text-align: center;">Actions</th>
                      @endcan
                    </tr>
                  </thead>
                  <tbody>
                  @forelse ($result as $index => $item)
                    <tr>
                      <td style="text-align: center;">
                        {{ $index + $result->firstItem() }}
                      </td>
                      <td><p style="margin-left: 15px;"><a href="{{ route('roles.show', $item->id) }}" title="View Role">
                        {{ ucfirst($item->name) }}</a></p>
                      </td>
                      <td style="text-align: center;">
                        {{ ucfirst($item->guard_name) }}
                      </td>
                      <td style="text-align: center;">
                        {{ $item->created_at->toFormattedDateString() }}
                      </td>
                      <td style="text-align: center;">
                        {{ $item->updated_at->toFormattedDateString() }}
                      </td>
                      @can ('edit_roles')
                      <td>
                        <div class="row">
                          <div class="btn-group" role="group">
                            <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                              @can ('edit_roles', $item)
                                <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-xs btn-info">Edit</a>
                              @endcan
                            </div>
                            <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                                @can ('delete_roles', $item)
                                  {!! Form::open( ['method' => 'delete', 'url' => route('roles.destroy', $item->id), 'onSubmit' => 'return confirm("Are yous sure wanted to delete ' . $item->name . ' ?")']) !!}
                                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                  {!! Form::close() !!}
                                @endcan
                            </div>
                          </div>
                        </div>
                      </td>
                      @endcan
                    </tr>
                  @empty
                    <tr>
                      <td>No Roles</td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} roles )</div>
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

@section('scripts')
  @include('shared._part_notification')
@endsection
