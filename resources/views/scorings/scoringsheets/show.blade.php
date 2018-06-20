@extends('layouts.dashboard')

@section('title', 'Detail Scoringsheet : Classroom ' . $classroom->classroomname . ' | ' . ucwords($subject->subjectname) . ' | ' . $year->yearname . ' | ' . $semester->semestername . ' | created by : ' . ucwords($classsubject->created_by))

@section('stylesheets')
  <style media="screen">
      #table-scroll {
        margin-left: 1px;
      }
      .table-scroll {
        position:relative;
        max-width:1600px;
        margin:auto;
        overflow:hidden;
      }
      .table-wrap {
        width:100%;
        overflow:auto;
      }
      .table-scroll table {
        width:100%;
        margin:auto;
        border-collapse:separate;
        border-spacing:0;
      }
      .table-scroll th, .table-scroll td {
        padding:5px 10px;
        border:1px solid #eee;
        background:#fff;
        white-space:nowrap;
        vertical-align:top;
      }
      .table-scroll thead, .table-scroll tfoot {
        background:#f9f9f9;
      }
      .clone {
        position:absolute;
        top:0;
        left:0;
        pointer-events:none;
      }
      .clone th, .clone td {
        visibility:hidden
      }
      .clone td, .clone th {
        border-color:transparent
      }
      .clone tbody th {
        visibility:visible;
        color:red;
      }
      .clone .fixed-side {
        border:1px solid white;
        background:#eee;
        visibility:visible;
      }
      .clone thead, .clone tfoot{background:transparent;}
      tr:hover {
          background-color: #eee;
      }
  </style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a href="{{route('scoringsheets.index')}}">Scoringsheets</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Show</a> <i class="fa  fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')
  <div class="row">
    <a href="{{ route('scoringsheets.index') }}" class="btn btn-xs btn-default">Back</a>
    <a href="{{route('scoringsheets.setscore', $classsubject->csbatch_id)}}" class="btn btn-xs btn-default" title="Setting Scoringsheet"><i class="fa fa-gear"></i></a>
    <a href="{{route('scoringsheets.showfullscreen', $classsubject->csbatch_id)}}" class="btn btn-xs btn-default" title="Fullscreen"><i class="fa fa-arrows-alt"></i></a>
    <a href="{{route('scoringsheets.inputscore', $classsubject->csbatch_id)}}" class="btn btn-xs btn-info">Input</a>
  </div>
@endsection

@section('content')
<div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
<div class="box box-primary collapsed-box" style="margin-top: 20px;">
  <div class="box-header">
    <div class="col-md-12" style="margin-left: -12px">
      @yield('navmenu')
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
</div>
    <div class="box" style="margin-top: -20px;">
      <div class="box-header" style="margin-left: 4px">
        <h3 class="box-title col-xs-12">@yield('button')</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class=" col-sm-12">
            <div id="table-scroll" class="table-scroll" style="margin-top: -10px; margin-bottom: 30px;">
              <div class="table-wrap">
              <table class="main-table">
                <thead>
                  <tr>
                      <th class="fixed-side" style="text-align: center;">No</th>
                      <th class="fixed-side" style="text-align: center;">No ID</th>
                      <th class="fixed-side" scope="col" style="text-align: right;">Student</th>
                        @if (count($arraydetails) > 0)
                          @for ($ar = 0; $ar < count($arraydetails); $ar++)
                            <th style="text-align: center;">
                              <a class="update-modal btn btn-xs" href="#" data-csbatch_id="{{$setscore->csbatch_id}}" data-index="{{$ar}}" data-detailscore="{{$arraydetails[$ar]}}"><b>{{$arraydetails[$ar]}}</b></a>
                            </th>
                          @endfor
                          @for ($i = count($arraydetails) + 1 ; $i <= $setscore->columnscore; $i++)
                            <th style="text-align: center;">{{$i}}</th>
                          @endfor
                        @else
                          @for ($i = 1; $i <= $setscore->columnscore; $i++)
                            <th style="text-align: center;">{{$i}}</th>
                          @endfor
                        @endif
                    </tr>
                    {{ csrf_field() }}
                  </thead>
                  <tbody>
                    @foreach ($result as $index => $item)
                      <tr>
                        <td class="fixed-side" style="text-align: center; background: #eee; border: 1px solid white;">{{$index + $result->firstItem()}}</td>
                        <td class="fixed-side" style="text-align: center; background: #eee; border: 1px solid white;">{{$item->noId}}</td>
                        <td class="fixed-side" style="text-align: right;">{{$item->studentname}}</td>
                        @for ($i = 0; $i < $setscore->columnscore; $i++)
                          <td style="text-align: center;" onblur="updatescore({{$item->id}},{{$i}})" id="name-{{$item->id}}-{{$i}}">
                            {{empty($arrayscores[$item->id][$i]) ? '' : $arrayscores[$item->id][$i]}}
                          </td>
                        @endfor
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
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
        // requires jquery library
        jQuery(document).ready(function() {
         jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
        });
    </script>
@endsection
