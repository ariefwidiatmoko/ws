<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Laravel') }} | Administrator Dashboard</title>
    <link rel="icon" href="/favicon.ico">
    <!-- Responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/src/css/all.css">
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
  </head>
  <body>
  <div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
      <div class="box box-primary collapsed-box" style="margin-top: 20px;">
        <div class="box-header">
          <div class="col-md-12">
            <div style="margin-left: -12px;">
              <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
              <a href="{{route('scoringsheets.index')}}">Scoringsheets</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
              <a class="active">Show</a> <i class="fa  fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
              <a class="active">{{'Detail Scoringsheet : Classroom ' . $classroom->classroomname . ' | ' . ucwords($subject->subjectname) . ' | ' . $year->yearname . ' | ' . $semester->semestername . ' | created by : ' . ucwords($classsubject->created_by)}}</a>
            </div>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
      </div>
      <div class="box" style="margin-top: -20px;">
        <div class="box-header" style="margin-left: 4px">
          <h3 class="box-title col-xs-12">
            <div class="row">
              <a href="{{route('scoringsheets.show', $classsubject->csbatch_id)}}" class="btn btn-xs btn-default">Back</a>
              <a href="#" class="btn btn-xs btn-default" title="Setting Scoringsheet"><i class="fa fa-gear"></i></a>
              <a href="{{route('scoringsheets.inputfullscreen', $classsubject->csbatch_id)}}" class="btn btn-xs btn-info">Input</a>
            </div>
          </h3>
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
                          <td class="fixed-side" style="text-align: center;">{{$index + $result->firstItem()}}</td>
                          <td class="fixed-side" style="text-align: center;">{{$item->noId}}</td>
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
          </div>
          <!-- /.box-body -->
        </div>
    </div>
    @include('layouts.parts.scripts')
    <script>
        // requires jquery library
        jQuery(document).ready(function() {
         jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
        });
    </script>
  </body>
</html>
