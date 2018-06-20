@extends('layouts.dashboard')

@section('title', 'Employees with position')

@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/yellow.css">
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">Position</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('positions.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Position...">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('button')
  @can('view_positions')
    <a href="{{ route('positions.index') }}" class="btn btn-default btn-xs pull-right m-t-5 m-r-10">Back</a>
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
        <h4 style="margin-left: 15px;"> {{ $position->positionname }} position</h4>
          <table id="inlist" class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Active</th>
                <th>Create by</th>
                <th>Updated by</th>
                <th>Created At</th>
                @can ('edit_employees', 'delete_employees')
                <th>Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
            @forelse ($position->employees as $index => $item)
                <tr>
                    <td>{{ $index += 1 }}</td>
                    <td>{{ ucfirst($item->employeename) }}</td>
                    <td>{{ $item->employeeactive == 1 ? 'Yes' : 'No' }}</td>
                    <td>{{ $item->created_by ? ucwords($item->created_by) : '' }}</td>
                    <td>{{ ucfirst($item->updated_by == null ? $item->user['name'] : $item->updated_by) }}</td>
                    <td>{{ $item->created_at->format('d M Y - H:i:s') }}</td>
                    @can ('edit_employees', 'delete_employees')
                    <td>
                      <div class="row">
                        <div class="btn-group" role="group">
                          <div class="col-xs-1 margin">
                            @can ('edit_employees', $item)
                              <a href="{{ route('employees.edit', $item->id) }}" class="btn btn-xs btn-info">Edit</a>
                            @endcan
                          </div>
                          <div class="col-xs-1 margin">
                            @can ('delete_employees', $item)
                              {!! Form::open( ['method' => 'delete', 'url' => route('employees.destroy', $item->id), 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
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
                    <td>No Employee</td>
                  </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
@endsection
