@extends('layouts.dashboard')

@section('title', 'Positions')

@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/yellow.css">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
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
  @can ('add_positions')
  <a href="{{ route('positions.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus fa-fw"></i> New Position</a>
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
                <th style="text-align: center;">Live</th>
                <th style="text-align: center;">Created by</th>
                <th style="text-align: center;">Updated by</th>
                <th style="text-align: center;">Created At</th>
                @can ('edit_positions', 'delete_positions')
                <th style="text-align: center;">Actions</th>
                @endcan
              </tr>
              {{ csrf_field() }}
            </thead>
            <tbody>
            @forelse ($result as $index => $item)
              <tr>
                <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                <td><a href="{{ route('positions.show', $item->id) }}">{{ ucfirst($item->positionname) }}</a></td>
                <td style="text-align: center;">
                  @can('edit_positions', $item)
                    <input type="checkbox" class="published" data-id="{{$item->id}}" @if ($item->positionactive) checked @endif>
                  @else
                    {{ $item->positionactive == 1 ? 'Yes' : 'No' }}
                  @endcan
                </td>
                <td style="text-align: center;">{{ $item->user['name'] }}</td>
                <td style="text-align: center;">{{ $item->updated_by == null ? $item->user['name'] : $item->updated_by }}</td>
                <td style="text-align: center;">{{ $item->created_at->toFormattedDateString() }}</td>
                @can ('edit_positions', 'delete_positions')
                <td>
                  <div class="row">
                    <div class="btn-group" role="group">
                      <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                        @can ('edit_positions', $item)
                          <a href="{{ route('positions.edit', $item->id) }}" class="btn btn-xs btn-info">Edit</a>
                        @endcan
                      </div>
                      <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                        @can ('delete_positions', $item)
                          {!! Form::open( ['method' => 'delete', 'url' => route('positions.destroy', $item->id), 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
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
                <td>No Position</td>
              </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} positions )</div>
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
    <!-- icheck checkboxes -->
    <script type="text/javascript" src="/src/iCheck/icheck.min.js"></script>
    @include('shared._part_notification')
    <script>
        $(document).ready(function(){
            $('.published').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '20%'
            });
            $('.published').on("ifClicked", function(event){
                id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::route('positions.publish') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function(data) {
                        // empty
                    },
                });
            });
            $('.published').on('ifToggled', function(event) {
                $(this).closest('tr').toggleClass('warning');
            });
            //Alert Sliding
            $('div.alert').not('.alert-important').delay(3000).slideUp(300);
        });
    </script>
@endsection
