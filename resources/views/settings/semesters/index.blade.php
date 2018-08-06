@extends('layouts.dashboard')

@section('title', 'Semester')

@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/yellow.css">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a>Settings</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('semesters.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Semester..">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('button')
  @can('add_semesters')
  <a href="{{ route('semesters.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus fa-fw"></i> New Semester</a>
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
                  <tr>
                      <th style="text-align: center;">No</th>
                      <th style="text-align: center;">Name</th>
                      <th style="text-align: center;">Alias</th>
                      <th style="text-align: center;">Created by</th>
                      <th style="text-align: center;">Created At</th>
                      @can ('edit_semesters', 'delete_semesters')
                      <th style="text-align: center;">Actions</th>
                      @endcan
                    </tr>
                    {{ csrf_field() }}
                  </thead>
                  <tbody>
                  @forelse ($result as $index => $item)
                    <tr>
                      <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                      <td style="text-align: center;">{{ ucfirst($item->semestername) }}</td>
                      <td style="text-align: center;">{{ ucfirst($item->alias) }}</td>
                      <td style="text-align: center;">{{ ucfirst($item->user['name']) }}</td>
                      <td style="text-align: center;">{{ $item->created_at->format('d M Y - H:i') }}</td>
                      @can ('edit_semesters', 'delete_semesters')
                      <td>
                        <div class="row">
                              <div class="btn-group" role="group">
                                <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                                @can ('edit_semesters', $item)
                                  <a href="{{ route('semesters.edit', $item->id) }}" class="btn btn-xs btn-info">Edit</a>
                                @endcan
                            </div>
                            <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                                @can ('delete_semesters', $item)
                                  {!! Form::open( ['method' => 'delete', 'url' => route('semesters.destroy', $item->id), 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
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
                      <td>No Semester</td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} semesters )</div>
              </div>
              <div class="col-sm-7 text-right" style="margin-top: -34px;">
                {!! $result->appends(Request::all())->render() !!}
              </div>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
</div>
@endsection

@section('scripts')
  @include('shared._part_notification')
@endsection
