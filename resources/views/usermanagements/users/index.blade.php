@extends('layouts.dashboard')

@section('title', 'Users')

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a>User Managements</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('users.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search User...">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('button')
  @can ('add_users')
    <a href="{{ route('users.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus fa-fw"></i> New User</a>
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
                      <th style="text-align: center;">Username</th>
                      <th style="text-align: center;">Email</th>
                      <th style="text-align: center;">Role</th>
                      @can ('edit_users')
                      <th style="text-align: center;">Link to Employee</th>
                      @endcan
                      <th style="text-align: center;">Change Password</th>
                      @can('edit_users', 'delete_user')
                      <th style="text-align: center;">Actions</th>
                      @endcan
                    </tr>
                  </thead>
                  <tbody>
                  @forelse ($result as $index => $item)
                    <tr>
                      <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                      <td style="text-align: center;">{{ ucfirst($item->name) }}</td>
                      <td style="text-align: center;">{{ $item->email }}</td>
                      <td style="text-align: center;">{{ $item->roles->implode('name', ', ') }}</td>
                      @can ('edit_users')
                        <td style="text-align: center;">
                          @if(isset($item->employee_id))
                            <a href="{{route('employees.edit', $item->employee->id)}}">{{$item->employee->employeename}}</a>
                            <a href="{{route('users.showLink', $item->id)}}"><i class="fa fa-pencil fa-fw"></i></a>
                          @else
                            <a href="{{route('users.showLink', $item->id)}}"><button class="btn btn-xs bg-blue">Set</button> </a>
                          @endif
                        </td>
                      @endcan
                      <td style="text-align: center;">
                      @can ('edit_users', $item)
                        <a href="{{ route('users.changePassword', $item->id) }}" class="btn btn-xs btn-default">Change</a>
                      @endcan</td>
                      <td>
                        <div class="row">
                          <div class="btn-group" role="group">
                              <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                              @can ('edit_users', $item)
                              <a href="{{ route('users.edit', $item->id) }}" class="btn btn-xs btn-info">Edit</a>
                              @endcan
                            </div>
                            <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                            @can ('delete_users', $item)
                              {!! Form::open( ['method' => 'delete', 'url' => route('users.destroy', $item->id), 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
                                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                              {!! Form::close() !!}
                            @endcan
                            </div>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td>No Users</td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} users )</div>
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
