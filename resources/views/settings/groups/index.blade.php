@extends('layouts.dashboard')

@section('title', 'Group Score')

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a>Settings</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')

  <a href="{{ route('groups.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus fa-fw"></i> New Group Score</a>

@endsection

@section('content')
<div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
<div class="box box-primary collapsed-box" style="margin-top: 20px;">
  <div class="box-header">
    <div class="col-md-6">
      @yield('navmenu')
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
                <th style="text-align: center;">Group Score</th>
                <th style="text-align: center;">Description</th>
                <th style="text-align: center;">Created by</th>
                @can ('edit_positions', 'delete_positions')
                <th style="text-align: center;"></th>
                @endcan
              </tr>
              {{ csrf_field() }}
            </thead>
            <tbody>
            @forelse ($result as $index => $item)
              <tr>
                <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                <td style="text-align: center;">{{ ucfirst($item->groupname) }}</td>
                <td style="text-align: center;">{{ $item->groupdescription }}</td>
                <td style="text-align: center;">{{ ucwords($item->created_by) }}</td>
                @can ('edit_positions', 'delete_positions')
                <td style="text-align: center;">
                  <div class="row">
                    <div class="btn-group" role="group">
                      <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                        @can ('edit_positions', $item)
                          <a href="{{ route('groups.edit', $item->id) }}" class="btn btn-xs btn-info">Edit</a>
                        @endcan
                      </div>
                      <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                        @can ('delete_positions', $item)
                          {!! Form::open( ['method' => 'delete', 'url' => route('groups.destroy', $item->id), 'onSubmit' => 'return confirm("Are yous sure wanted to delete ' . $item->groupname . ' ?")']) !!}
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
                <td>No Group Score</td>
              </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} groups )</div>
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
    <script>
        $(document).ready(function(){
            //Alert Sliding
            $('div.alert').not('.alert-important').delay(3000).slideUp(300);
        });
    </script>
@endsection
