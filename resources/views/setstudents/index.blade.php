@extends('layouts.dashboard')

@section('title', 'Student')

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
    <form action="{{ route('students.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Student..">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('btn1')
 @include('setstudents.filterRequest')
@endsection

@section('btn2')
 @include('setstudents.actionRequest')
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
      <div class="box-header" style="margin-left: -15px">
        <h3 class="box-title col-xs-12" style="margin-top: 15px">@yield('btn1')</h3>
        <h3 class="box-title col-xs-12">@yield('btn2')</h3>
      </div>
      <!-- /.box-header -->
      <div id="inlist" class="table-responsive box-body">
          <div class="row">
            <div class="col-sm-12">
              <table id="inlist" class="table table-hover">
                <thead>
                  <tr>
                      <th style="text-align: center;">No</th>
                      <th style="text-align: center;"><input type="checkbox" name="file_id" value="0" class="selector all"></th>
                      <th style="text-align: center;">ID</th>
                      <th>Student</th>
                      <th style="text-align: center;">Grade</th>
                      <th style="text-align: center;">Year</th>
                    </tr>
                    {{ csrf_field() }}
                  </thead>
                  <tbody>
                  @forelse ($result as $index => $item)
                    <tr>
                      <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                      <td style="text-align: center;">
                        <input id="check" type="checkbox" name="id[]" class="selector" value="{{$item->id}}">
                      </td>
                      <td style="text-align: center;">{{ $item->noId }}</td>
                      <td><a href="{{route('setstudents.show', $item->id)}}">{{ ucwords($item->studentname) }}</a></td>
                      <td style="text-align: center;">@if(isset($item->grade_id)) {{$item->gradename}} @else Not Set @endif</td>
                      <td style="text-align: center;">@if(isset($item->year_id)) {{ucwords($item->yearname)}} @else Not Set @endif</td>
                    </tr>
                  @empty
                    <tr>
                      <td>No Student</td>
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

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="/src/iCheck/icheck.min.js"></script>
    @include('shared._part_notification')
    <script>
        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '20%'
            });
            $('input.all').on('ifToggled', function (event) {
                var chkToggle;
                $(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
                $('input.selector:not(.all)').iCheck(chkToggle);
            });
            $('.statusActive').on('ifToggled', function(event) {
                $(this).closest('tr').toggleClass('warning');
            });
        });
    </script>
@endsection
