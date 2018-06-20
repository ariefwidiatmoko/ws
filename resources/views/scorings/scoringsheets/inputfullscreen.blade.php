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
          max-width:1680px;
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
      <div class="col-md-12" style="margin-left: -12px">
        <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
        <a href="{{route('scoringsheets.index')}}">Scoringsheets</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
        <a href="{{route('scoringsheets.show', $classsubject->csbatch_id)}}">Show</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
        <a class="active">Input</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
        <a class="active">{{'Detail Scoringsheet : Classroom ' . $classroom->classroomname . ' | ' . ucwords($subject->subjectname) . ' | ' . $year->yearname . ' | ' . $semester->semestername . ' | created by : ' . ucwords($classsubject->created_by)}}</a>
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
              <a href="{{route('scoringsheets.inputscore', $classsubject->csbatch_id)}}" class="btn btn-xs btn-default" title="Leave Fullscreen"><i class="fa fa-compress"></i></a>
            </div>
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12">
              <div id="table-scroll" class="table-scroll" style="margin-top: -10px; margin-bottom: 30px;">
                <div class="table-wrap">
                  <table class="main-table" style="margin-bottom: 15px;">
                    <thead>
                      <tr>
                          <th class="fixed-side" style="text-align: center; vertical-align: middle;" colspan="3">Competency</th>
                            @if (count($arraydetails) > 0)
                              @for ($ar = 0; $ar < count($arraydetails); $ar++)
                                <th style="text-align: center;" colspan="1">
                                  <a class="update-modal btn btn-xs" data-csbatch_id="{{$setscore->csbatch_id}}" data-index="{{$ar}}" data-detailscore="{{empty($arraydetails[$ar]) ? '' : $arraydetails[$ar]}}"><b><i class="fa fa-plus-square"></i></b></a>
                                </th>
                              @endfor
                              @for ($i = count($arraydetails); $i < $setscore->columnscore; $i++)
                                <th style="text-align: center;" colspan="1">
                                  <a class="{{count($arraydetails) == $i ? 'update-modal' : ''}} btn btn-xs" style="{{count($arraydetails) == $i ? '' : 'color: grey;'}}" data-csbatch_id="{{$setscore->csbatch_id}}" data-index="{{$i}}"><b><i class="fa fa-plus-square"></i></b></a>
                                </th>
                              @endfor
                            @else
                              @for ($i = 0; $i < $setscore->columnscore; $i++)
                                <th style="text-align: center;" colspan="1">
                                  <a class="{{$i == 0 ? 'update-modal' : ''}} btn btn-xs" href="#" style="{{count($arraydetails) == $i ? '' : 'color: grey; text-decoration: none;'}}" data-csbatch_id="{{$setscore->csbatch_id}}" data-index="{{$i}}"><b><i class="fa fa-plus-square"></i></b></a>
                                </th>
                              @endfor
                            @endif
                            <th style="text-align: center;" colspan="{{count($uniques) == 0 ? 1 : count($uniques)}}">Average</th>
                            @foreach ($uniques as $i)
                            <th style="text-align: center; vertical-align: middle;" rowspan="2">20%<br>{{$detail_avgs[$i]}}</th>
                            @endforeach
                            <th style="text-align: center; vertical-align: middle;" rowspan="2">Final</th>
                            <th style="text-align: center; vertical-align: middle;" rowspan="2">Grade</th>
                        </tr>
                        <tr>
                            <th class="fixed-side" style="text-align: center; vertical-align: middle;">No</th>
                            <th class="fixed-side" style="text-align: center; vertical-align: middle;">No ID</th>
                            <th class="fixed-side" scope="col" style="text-align: right; vertical-align: middle;">Student</th>
                          @if (count($arraydetails) > 0)
                            @for ($ar = 0; $ar < count($arraydetails); $ar++)
                              <th style="text-align: center;">
                                <a class="update-modal btn btn-xs" data-csbatch_id="{{$setscore->csbatch_id}}" data-index="{{$ar}}" data-detailscore="{{empty($arraydetails[$ar]) ? '' : $arraydetails[$ar]}}"><b>{{empty($arraydetails[$ar]) ? '' : $arraydetails[$ar]}}</b></a>
                              </th>
                            @endfor
                            @for ($i = count($arraydetails); $i < $setscore->columnscore; $i++)
                              <th style="text-align: center;">
                                <a class="{{count($arraydetails) == $i ? 'update-modal' : ''}} btn btn-xs" style="{{count($arraydetails) == $i ? '' : 'color: grey;'}}" data-csbatch_id="{{$setscore->csbatch_id}}" data-index="{{$i}}"><b>{{$i+1}}</b></a>
                              </th>
                            @endfor
                          @else
                            @for ($i = 0; $i < $setscore->columnscore; $i++)
                              <th style="text-align: center;">
                                <a class="{{$i == 0 ? 'update-modal' : ''}} btn btn-xs" href="#" style="{{count($arraydetails) == $i ? '' : 'color: grey; text-decoration: none;'}}" data-csbatch_id="{{$setscore->csbatch_id}}" data-index="{{$i}}"><b>{{$i+1}}</b></a>
                              </th>
                            @endfor
                          @endif
                          @foreach ($uniques as $i)
                          <th style="text-align: center;">{{$detail_avgs[$i]}}</th>
                          @endforeach
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
                              <td @if ($i < count($arraydetails)) onclick="document.execCommand('selectAll',false,null)" @endif
                                  style="text-align: center;"
                                  onblur="updatescore({{$item->id}},{{$i}})"
                                  id="name-{{$item->id}}-{{$i}}"
                                  contenteditable="{{$i >= count($arraydetails) ? 'false' : 'true'}}">{{!isset($arrayscores[$item->id][$i]) ? '' : $arrayscores[$item->id][$i]}}
                              </td>
                            @endfor
                            @foreach ($avgs as $index => $item2)
                              <td style="text-align: center;">
                                @php
                                  $avg = collect(array_intersect_key($arrayscores[$item->id], $item2->toArray()))->filter(function($value, $key) { return $value >= 0 && isset($value); })->avg();
                                  print number_format($avg, 2, '.', ',');
                                @endphp
                              </td>
                            @endforeach
                            @foreach ($avgs as $index => $item2)
                              <td style="text-align: center;">
                                @php
                                  $avg = collect(array_intersect_key($arrayscores[$item->id], $item2->toArray()))->avg();
                                  print number_format($avg, 2, '.', ',');
                                @endphp
                              </td>
                            @endforeach
                            <td></td>
                            <td></td>
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
    @include('scorings.scoringsheets._modal_columndetail')
    @include('layouts.parts.scripts')
    @include('shared._part_notification')
    <script>
        // requires jquery library
        jQuery(document).ready(function() {
         jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
        });
        //Edit Column Score
        $(document).on('click', '.update-modal', function() {
            $('.modal-title').text('Set Detail Scoring');
            $('#csbatch_id_edit').val($(this).data('csbatch_id'));
            $('#index_edit').val($(this).data('index'));
            id = $('#csbatch_id_edit').val();
            $('#updateModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: '/home/scorings/scoringsheets/update-column-score/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#csbatch_id_edit").val(),
                    'index': $("#index_edit").val(),
                    'detailscore': $('#detailscore_edit').val(),
                    'detailnumber': $('#detailnumber_edit').val(),
                },
                success: function(data) {
                    window.location.reload();
                },
            });
        });

        function updatescore(id,index) {
          var name = $("#name-"+id+"-"+index).html();

          if(isNaN(name)|| name > 100 || name < 0)
             {
                  alert("Insert score in 0-100 range");
                  setTimeout(function(){
                    window.location.reload();;
                  },200);
                  return false;
             }
          $.ajax({
            type: 'POST',
            url:"{{ URL::route('scoringsheets.updatescore')}}",
            data: {
              '_token': $('input[name=_token]').val(),
              'id': id,
              'index': index,
              'name' : name
            },
          });
        }
    </script>
  </body>
</html>
