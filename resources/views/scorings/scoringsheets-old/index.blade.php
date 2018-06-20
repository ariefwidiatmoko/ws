@extends('layouts.dashboard')

@section('title', 'Scoring Sheet')

@section('stylesheets')
    <style media="screen">
      tr>td {
              cursor: pointer;
            }
      tr>td:hover {
                    color: #458dd5;
                  }
    </style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')
  <div class="text-right">
    <form action="#" method="GET">
      <div class="input-group input-group-sm col-md-12">
        <input type="text" name="search" class="form-control pull-right" placeholder="Search Scoring..">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('button')
  <a href="{{ route('scoringsheets.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus fa-fw"></i> New Scoringsheet</a>
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
        <h3 class="box-title col-xs-12" style="margin-top: 15px">@yield('button')</h3>
      </div>
      <!-- /.box-header -->
      <div id="inlist" class="table-responsive box-body">
          <div class="row">
            <div class="col-sm-12">
              <table id="inlist" class="table table-hover">
                <thead>
                  <tr>
                      <th style="text-align: center;">No</th>
                      <th style="text-align: center;">Classroom</th>
                      <th style="text-align: center;">Teacher</th>
                      <th style="text-align: center;">Year</th>
                      <th style="text-align: center;">Semester</th>
                      <th style="text-align: center;">Created at</th>
                      <th style="text-align: center;">Updated at</th>
                    </tr>
                    {{ csrf_field() }}
                  </thead>
                  <tbody>
                    @forelse ($result as $index => $item)
                      <tr class="clickable-row" data-href="{{route('scoringsheets.show', $item->id)}}">
                        <td style="text-align: center;">{{$index + $result->firstItem()}}</td>
                        <td style="text-align: center;">{{$item->classroomname}}</td>
                        <td style="text-align: center;">{{ucwords($item->created_by)}}</td>
                        <td style="text-align: center;">{{$item->yearname}}</td>
                        <td style="text-align: center;">{{$item->semestername}}</td>
                        <td style="text-align: center;">{{$item->created_at}}</td>
                        <td style="text-align: center;">{{$item->updated_at ? $item->updated_at : ''}}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="7">No Scoring Sheet</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>

            </div>
            <div class="row">
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
    @include('shared._part_notification')
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection
