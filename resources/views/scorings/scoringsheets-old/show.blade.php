@extends('layouts.dashboard')

@section('title', 'Scoring Sheet')

@section('stylesheets')
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
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
  <div class="row">
    <a href="{{ route('scoringsheets.index') }}" class="btn btn-xs btn-default">Back</a>
    <a href="{{ route('scoringsheets.setscoringsheet', $cs->id) }}" class="btn btn-xs btn-success">Setting</a>
  </div>
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
        <h3 class="box-title col-xs-12" style="margin-top: 15px; margin-left: 15px;">@yield('button')</h3>
      </div>
      <!-- /.box-header -->
      <div id="inlist" class="table-responsive box-body">
        <div class="row">
          <div class="col-sm-12">
            <table id="inlist" class="table table-hover">
              <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">No ID</th>
                    <th style="text-align: center;">Student</th>
                    <th style="text-align: center;">Col 1</th>
                    <th style="text-align: center;">Col 2</th>
                    <th style="text-align: center;">Col 3</th>
                    <th style="text-align: center;">Col 4</th>
                    <th style="text-align: center;">Col 5</th>
                    <th style="text-align: center;">Col 6</th>
                    <th style="text-align: center;">Col 7</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody>
                  @foreach ($result as $index => $item)
                    <tr>
                      <td style="text-align: center;">{{$index + $result->firstItem()}}</td>
                      <td style="text-align: center;">{{$item->noId}}</td>
                      <td style="text-align: center;">{{$item->studentname}}</td>
                    </tr>

                  @endforeach
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

@section('scripts')
    <!-- toastr notifications -->
    <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>
    @include('shared._part_notification')
@endsection
