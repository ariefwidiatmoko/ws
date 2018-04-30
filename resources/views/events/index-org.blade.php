@extends('layouts.dashboard')

@section('title', 'Events')

@section('stylesheets')
  <!-- fullcalendar -->
  <link rel="stylesheet" href="/src/fullcalendar/dist/fullcalendar.min.css">
  <!-- Datetimepicker -->
  <link rel="stylesheet" href="/src/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css" />
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="{{ route('posts.index') }}" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Title / Content...">
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
      <!-- /.box-header -->
      <div class="box-body"><br>
        <div class="row">
          <div class="col-md-6">
            <form class="" action="{{ route('events.store') }}" method="post">
              {{ csrf_field() }}
              <!-- User_id -->
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <!-- Name -->
              <div class="col-xs-3">
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                  <label>Add Event</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="name" value="">
                    <span class="input-group-addon">
                      <input type="checkbox" name="allday" id="checkAllday" onclick="infoAllday()" checked>
                    </span>
                  </div><p id="infoAllday" style="display:block">(All day)</p>
                  @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group">
                  <label>Color</label>
                  <select class="form-control" name="event_color">
                    <option value="0">Choose</option>
                    <option value="0" style="background-color: #367fa9; color: white;">Blue</option>
                    <option value="1" style="background-color: #00a65a; color: white;">Green</option>
                    <option value="2" style="background-color: #dd4b39; color: white;">Red</option>
                    <option value="3" style="background-color: #f012be; color: white;">Pink</option>
                    <option value="4" style="background-color: #f39c12; color: white;">Yellow</option>
                    <option value="5" style="background-color: #777; color: white;">Grey</option>
                    <option value="6" style="background-color: #ff851b; color: white;">Orange</option>
                    <option value="7" style="background-color: #00c0ef; color: white;">Aqua</option>
                  </select>
                </div>
              </div>
              <!-- Event Start -->
              <div class="col-xs-3">
                <div class="form-group @if ($errors->has('event_start')) has-error @endif">
                  <label><i class="fa fa-calendar fa-fw"></i>Start</label>
                  <input value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" name="event_start" type="text" class="form-control" id="datetimepicker1" data-date-format="YYYY-MM-DD">
                </div>
              </div>
              <!-- Event End -->
              <div class="col-xs-4">
                <div class="form-group @if ($errors->has('event_end')) has-error @endif">
                  <label><i class="fa fa-calendar fa-fw"></i>End</label>
                  <div class="input-group">
                    <input value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" name="event_end" type="text" class="form-control" id="datetimepicker2" data-date-format="YYYY-MM-DD">
                    <div class="input-group-btn">
                      <button type="submit" name="submit" class="btn btn-success">Save</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 row" id="timeInput" style="display:none">
                <div class="col-md-3">
                    <div class="form-group @if ($errors->has('time_start')) has-error @endif">
                      <label><i class="fa fa-clock-o fa-fw"></i>Start</label>
                      <input value="{{ Carbon\Carbon::today()->format('H:i') }}" name="time_start" type="text" class="form-control" id="datetimepicker3" data-date-format="HH:mm">
                    </div>
                </div>
                  <div class="col-md-3">
                      <div class="form-group @if ($errors->has('time_end')) has-error @endif">
                        <label><i class="fa fa-clock-o fa-fw"></i>End</label>
                        <input value="{{ Carbon\Carbon::today()->format('H:i') }}" name="time_end" type="text" class="form-control" id="datetimepicker4" data-date-format="HH:mm">
                      </div>
                  </div>
              </div>
            </form>
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Event Name</th>
                  <th style="text-align: center;">Time</th>
                  <th style="text-align: center;">All day</th>
                  <th style="text-align: center;">Start</th>
                  <th style="text-align: center;">End</th>
                  <th style="text-align: center;">Created By</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($table_events as $item)
                  <tr>
                    <td> <i class="fa fa-circle fa-fw" style="color: {{$item->event_color}};"></i>{{ ucfirst($item->name) }}</td>
                    <td style="text-align: center;">
                      @if($item->event_start->diffInDays($item->event_end) >= 1 && $item->allday == 1)
                        {{$item->event_start->diffInDays($item->event_end) + 1}} Days
                      @elseif(($item->event_start->diffInDays($item->event_end) >= 1 && $item->allday == 0))
                        {{$item->event_start->format('H:i').' - '.$item->event_end->format('H:i')}}
                      @else
                        @if ($item->allday == 1)
                          All day
                        @else
                          {{$item->event_start->format('H:i').' - '.$item->event_end->format('H:i')}}
                        @endif
                      @endif
                    </td>
                    <td style="text-align: center;">
                      @if($item->event_start->diffInDays($item->event_end) >= 1 && $item->allday <= 1)
                        {{$item->event_start->format('d').' - '.$item->event_end->format('d M Y')}}
                      @else
                        {{$item->event_start->format('d M Y')}}
                      @endif
                    </td>
                    <td style="text-align: center;">{{ ucfirst($item->user->name) }}</td>
                  </tr>
                @empty
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <div style="border: 1px solid #d2d6de;">
              {!! $calendar_details->calendar() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <!-- Datetimepicker -->
    <script type="text/javascript" src="{{ asset('src/moment/min/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!-- toastr notifications -->
    <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>
    <!-- fullcalendar -->
    <script type="text/javascript" src="/src/fullcalendar/dist/fullcalendar.min.js"></script>
    <script>
      function infoAllday() {
        // Get the checkbox
        var checkBox = document.getElementById("checkAllday");
        // Get the output text
        var info = document.getElementById("infoAllday");
        var timeInput = document.getElementById("timeInput");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true){
          info.style.display = "block";
          timeInput.style.display = "none";
        } else {
          info.style.display = "none";
          timeInput.style.display = "block";
        }
      };
      /* Datetimepicker*/
      $(function dateTimePicker() {
        $('#datetimepicker1').datetimepicker({
            sideBySide: true
        });
        $('#datetimepicker2').datetimepicker({
            sideBySide: true
        });
        $('#datetimepicker3').datetimepicker({
            sideBySide: true
        });
        $('#datetimepicker4').datetimepicker({
            sideBySide: true
        });
      });
    </script>
    {!! $calendar_details->script() !!}
@endsection
