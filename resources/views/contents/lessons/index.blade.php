@extends('layouts.dashboard')

@section('title', 'Lessons')

@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/yellow.css">
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Contents</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('lessons.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Title / Content..." onfocus="this.value=''" value="{{ old('search') }}" id="simple-search">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('button')
  @can ('add_lessons')
  <a href="{{ route('lessons.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus fa-fw"></i> New Lesson</a>
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
      <div class="col-md-3 hidden-xs hidden-sm" style="margin-top: -7px; margin-left: -25px;">
        <button type="button" class="btn btn-box-tool" onclick="document.getElementById('simple-search').value = ''" data-widget="collapse"><h6>Advance Search <i class="fa fa-plus-square-o fa-fw"></i></h6></button>
      </div>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body" style="display: none">
    <div class="row" style="margin-left: 1px; margin-top: -8px;">
      @include('contents.lessons.advsearch')
    </div>
  </div>
  <!-- /.box-body -->
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
                    <th>Title</th>
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Created by</th>
                    <th style="text-align: center;">Active</th>
                    @can ('edit_lessons', 'delete_lessons')
                    <th style="text-align: center;">Actions</th>
                    @endcan
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody>
                @forelse ($result as $index => $item)
                  <tr>
                    <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                    <td>
                      <a href="{{ route('lessons.show', $item->id) }}" title="View Lesson">{{ $item->lessontitle }}</a>
                    </td>
                    <td style="text-align: center;">{{ $item->subject->subjectname }}</td>
                    <td style="text-align: center;">{{ ucfirst($item->user['name']) }}</td>
                    <td style="text-align: center;">
                      @can('edit_lessons', $item)
                        <input type="checkbox" class="published" data-id="{{$item->id}}" @if ($item->lessonactive) checked @endif>
                      @else
                        {{ $item->lessonactive == 1 ? 'Yes' : 'No' }}
                      @endcan
                    </td>
                    @can ('edit_lessons', 'delete_lessons')
                    <td>
                      <div class="row">
                        <div class="btn-group" role="group">
                          <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                              @can ('edit_lessons', $item)
                                <a href="{{ route('lessons.edit', $item->id) }}" class="btn btn-xs btn-info">Edit</a>
                              @endcan
                          </div>
                          <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">
                              @can ('delete_lessons', $item)
                                {!! Form::open( ['method' => 'delete', 'url' => route('lessons.destroy', $item->id), 'onSubmit' => 'return confirm("Are you sure want to delete ' . $item->lessontitle .' ?")']) !!}
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
                    <td>No Lesson</td>
                  </tr>
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5">
              <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} lessons )</div>
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
    <!-- toastr notifications -->
    <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>

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
                    url: "{{ URL::route('lessons.publish') }}",
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
