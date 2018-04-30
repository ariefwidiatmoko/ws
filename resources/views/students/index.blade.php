@extends('layouts.dashboard')

@section('title', 'Students')

@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/yellow.css">
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('students.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Students...">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('button')
  @can ('add_students')
  <a href="{{ route('students.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus fa-fw"></i> New Student</a>
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
                  <th style="text-align: center;">Fullname</th>
                  <th style="text-align: center;">Grade</th>
                  <th style="text-align: center;">Year</th>
                  <th style="text-align: center;">Semester</th>
                  <th style="text-align: center;">Active</th>
                  @can('edit_students')
                  <th style="text-align: center;">Actions</th>
                  @endcan
                </tr>
                {{ csrf_field() }}
              </thead>
              <tbody>
              @forelse ($result as $index => $item)
                <tr>
                  <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                  <td>{{ ucfirst($item->fullname) }}</td>
                  <td>Grade 7</td>
                  <td>2018</td>
                  <td>Semester 1</td>
                  <td style="text-align: center;">
                    @can('edit_students', $item)
                      <input type="checkbox" class="statusActive" data-id="{{$item->id}}" @if ($item->statusActive) checked @endif>
                    @else
                      {{ $item->statusActive == 1 ? 'Yes' : 'No' }}
                    @endcan
                  </td>
                  <td>
                    <div class="row">
                      <div class="btn-group" role="group">
                        <div class="col-xs-1 margin">
                          @can ('edit_students')
                            <a href="{{ route('students.edit', $item->id) }}" class="btn btn-xs btn-info">View</a>
                          @endcan
                        </div>
                        <div class="col-xs-1 margin">
                            @can ('delete_students')
                              {!! Form::open( ['method' => 'delete', 'url' => route('students.destroy', $item->id), 'onSubmit' => 'return confirm("Are you sure you want to delete it?")']) !!}
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
                  <td>No Students</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} students )</div>
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
    <!-- toastr notifications -->
    <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="/src/iCheck/icheck.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.statusActive').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '20%'
            });
            $('.statusActive').on("ifClicked", function(event){
                id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::route('students.statusActive') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function(data) {
                        // empty
                    },
                });
            });
            $('.statusActive').on('ifToggled', function(event) {
                $(this).closest('tr').toggleClass('warning');
            });
        });

    </script>
@endsection
