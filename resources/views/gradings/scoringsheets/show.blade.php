@extends('layouts.dashboard')

@section('title', ucwords($subject->subjectname) . ' - ' . $classroom->classroomname . ' | ' . $year->yearname . ' - ' . $semester->semestername . ' | created by : ' . ucwords($classsubject->created_by))

@section('stylesheets')
  @include('gradings.scoringsheets._style_scoringsheet')
  <style media="screen">
    i.icon {
      font-size: 16px;
    }
  </style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Gradings</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a href="{{route('scoringsheets.index')}}">Scoringsheets</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Show</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')
  <div class="row">
    <a href="{{route('scoringsheets.index')}}" title="Back" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i></a>
    @if (Request::is('home/gradings/scoringsheets/show-score/3/*'))
      <a href="{{route('scoringsheets.inputscore', [3, $classsubject->csbatch_id])}}" class="btn btn-xs btn-info">Input</a>
    @else
      <a href="{{route('scoringsheets.inputscore', [4, $classsubject->csbatch_id])}}" class="btn btn-xs btn-info">Input</a>
    @endif
  </div>
@endsection

@section('content')
<div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
<div class="box box-primary collapsed-box" style="margin-top: 20px;">
  <div class="box-header">
    <div class="col-md-12" style="margin-left: -12px">
      @yield('navmenu')
    </div>
    {{--box-tools--}}
  </div>
  {{--box-header--}}
</div>
<div class="nav-tabs-custom">
  <ul id="listtab" class="nav nav-tabs">
    <li class="{{ Request::is('home/gradings/scoringsheets/show-score/3/*') ? 'active' : '' }}"><a href="{{route('scoringsheets.showscore', [$peng->id, $classsubject->csbatch_id])}}">{{$peng->typedescription}}</a></li>
    <li class="{{ Request::is('home/gradings/scoringsheets/show-score/4/*') ? 'active' : '' }}"><a href="{{route('scoringsheets.showscore', [$ketr->id, $classsubject->csbatch_id])}}">{{$ketr->typedescription}}</a></li>
    <li class=""><a href="{{route('scoringsheets.showcompetency', [3, $classsubject->csbatch_id])}}">KD {{$peng->typedescription}}</a></li>
    <li class=""><a href="{{route('scoringsheets.showcompetency', [4, $classsubject->csbatch_id])}}">KD {{$ketr->typedescription}}</a></li>
    @if (Request::is('home/gradings/scoringsheets/show-score/3/*'))
      <li class="pull-right">
        <div class="row" style="margin: 10px;">
          <a href="#" title="Download Excel"><i class="fa fa-download fa-fw icon"></i></a>
          <a href="#" data-csbatch_id="{{$setscore->csbatch_id}}" data-type_id="{{$peng->id}}" class="column-score-modal" title="Setting"><i class="fa fa-gear icon"></i></a>
        </div>
      </li>
    @else
      <li class="pull-right">
        <div class="row" style="margin: 10px;">
          <a href="#" title="Download Excel"><i class="fa fa-download fa-fw"></i></a>
          <a href="#" data-csbatch_id="{{$setscore->csbatch_id}}" data-type_id="{{$ketr->id}}" class="column-score-modal" title="Setting"><i class="fa fa-gear fa-fw"></i></a>
        </div>
      </li>
    @endif
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="{{$peng->typedescription}}">
      <div class="box-header" style="margin-left: 4px">
        <h3 class="box-title col-xs-12">@yield('button')</h3>
      </div>
      {{--box-header--}}
      <div class="box-body">
        <div class="row">
          <div class=" col-sm-12">
            <div id="table-scroll" class="table-scroll" style="margin-top: -10px; margin-bottom: 30px;">
              <div class="table-wrap">
                <table class="main-table" style="margin-bottom: 10px;">
                  <thead>
                    <tr>
                        <th class="fixed-side" style="text-align: center; vertical-align: middle;" colspan="3">Competency<i class="fa fa-angle-double-right fa-fw"></i></th>
                          {{-- Display Compentency Detail, Check if Column Score already set minimum 1 --}}
                          @if (count($arraydetails) > 0)
                            {{-- Display Compentency Detail that has/can been set --}}
                            @for ($ar = 0; $ar < count($arraydetails); $ar++)
                              <th style="text-align: center;" colspan="1">
                                <a class="column-competency-modal btn btn-xs" title="Competency"><b>{!! !isset($arraycompetencies[$ar]) ? '<i class="fa fa-plus-square"></i>' : 'KD ' . $peng->id . '.' . (1 + $arraycompetencies[$ar]) !!}</b></a>
                              </th>
                            @endfor
                            {{-- Display Competency Detail that is still disabled/empty --}}
                            @for ($i = count($arraydetails); $i < $setscore->columnscore; $i++)
                              <th style="text-align: center;" colspan="1">
                                <a class="{{!isset($arraydetails[$i]) ? 'warning-competency-modal' : 'column-competency-modal'}} btn btn-xs" style="color: grey;"><b><i class="fa fa-plus-square"></i></b></a>
                              </th>
                            @endfor
                          @else
                            {{-- Display All Competency Detail that is still disabled/empty --}}
                            @for ($i = 0; $i < $setscore->columnscore; $i++)
                              <th style="text-align: center;" colspan="1">
                                <a class="{{$i == 0 ? 'column-competency-modal' : ''}} btn btn-xs" href="#" style="color: grey; text-decoration: none;"><b><i class="fa fa-plus-square"></i></b></a>
                              </th>
                            @endfor
                          @endif
                          {{-- Display Head Column Average --}}
                          <th style="text-align: center;" colspan="{{count($uniques) == 0 ? 1 : count($uniques)}}">Average</th>
                          {{-- Display Group Detail & Percent Detail --}}
                          @if (count($arraygroups) > 0)
                            @for ($ar = 0; $ar < count($arraygroups); $ar++)
                              <th style="text-align: center; vertical-align: middle;" colspan="1">
                                <a class="column-group-modal btn btn-xs" href="#">
                                  <b>{{!isset($arraygroup_percentages[$ar]) ? '' : $arraygroup_percentages[$ar].'%'}} {{!isset($arraygroups[$ar]) ? '' : '('.$group_ids[$arraygroups[$ar]].')'}}</b>
                                </a>
                              </th>
                            @endfor
                            @for ($ar = count($arraygroups); $ar < count($uniques); $ar++)
                              <th style="text-align: center; vertical-align: middle;" colspan="1">
                                <a class="column-group-modal btn btn-xs" href="#">
                                  <b><i class="fa fa-plus-square"></i></b>
                                </a>
                              </th>
                            @endfor
                          @else
                            @foreach ($uniques as $index => $i)
                              <th style="text-align: center; vertical-align: middle;" colspan="1">
                                <a class="column-group-modal btn btn-xs" href="#" title="Group Score">
                                  <b><i class="fa fa-plus-square"></i></b>
                                </a>
                              </th>
                            @endforeach
                          @endif
                          <th style="text-align: center; vertical-align: middle;" colspan="{{count($group_uniques) == 0 ? 1 : count($group_uniques)}}">Group Score</th>
                          <th style="text-align: center; vertical-align: middle;" rowspan="2">Final</th>
                          <th style="text-align: center; vertical-align: middle;" rowspan="2">Grade</th>
                      </tr>
                      <tr>
                          <th class="fixed-side" style="text-align: center; vertical-align: middle;">No</th>
                          <th class="fixed-side" style="text-align: center; vertical-align: middle;">No ID</th>
                          <th class="fixed-side" scope="col" style="text-align: right; vertical-align: middle;">Student</th>
                        {{-- Display Detail Column, Check if Detail Column has been set, min 1 --}}
                        @if (isset($arraydetails))
                          {{-- Display Detail Column, that has been set, min 1 --}}
                          @for ($ar = 0; $ar < count($arraydetails); $ar++)
                            <th style="text-align: center;">
                              <a class="column-detail-modal btn btn-xs" title="Column Score"><b>{{!isset($arraydetails[$ar]) ? '' : $arraydetails[$ar]}}</b></a>
                            </th>
                          @endfor
                          {{-- Display Detail Column, that is still disabled/empty --}}
                          @for ($i = count($arraydetails); $i < $setscore->columnscore; $i++)
                            <th style="text-align: center;">
                              <a class="btn btn-xs" style="color: grey;"><b>{{$i+1}}</b></a>
                            </th>
                          @endfor
                        @else
                          {{-- Display All Detail Column, that is still disabled/empty --}}
                          @for ($i = 0; $i < $setscore->columnscore; $i++)
                            <th style="text-align: center;">
                              <a class="btn btn-xs" href="#" style="color: grey; text-decoration: none;"><b>{{$i+1}}</b></a>
                            </th>
                          @endfor
                        @endif
                        {{-- Display Sub Average Detail Score --}}
                        @if (count($arraydetails) > 0)
                          @foreach ($uniques as $i)
                          <th style="text-align: center;"><a class="btn btn-xs" href="#" style="color: black;"><b>{{$detail_avgs[$i]}}</b></a></th>
                          @endforeach
                        @else
                          <th style="text-align: center;"><a class="btn btn-xs" href="#" style="color: black;"><b></b></a></th>
                        @endif
                        {{-- Display Group Detail Score --}}
                        @foreach ($uniques as $i)
                          <th style="text-align: center;"><a class="btn btn-xs" href="#" style="color: black;"><b>{{$detail_avgs[$i]}}</b></a></th>
                        @endforeach
                        @foreach ($group_uniques as $i)
                          <th style="text-align: center; vertical-align: middle;" rowspan="2"><a class="btn btn-xs" href="#" style="color: black;"><b>{{$group_ids[$i]}}</b></a></th>
                        @endforeach
                      </tr>
                      {{ csrf_field() }}
                    </thead>
                    <?php $array_finals = array(); ?>
                    <tbody>
                      <?php $no = 1; ?>
                      @foreach ($result as $index => $item)
                        <tr>
                          <td class="fixed-side" style="text-align: center;">{{$no}}</td>
                          <td class="fixed-side" style="text-align: center;">{{$item->noId}}</td>
                          <td class="fixed-side" style="text-align: right;">{{$item->studentname}}</td>
                          @for ($i = 0; $i < $setscore->columnscore; $i++)
                            <td style="text-align: center;">{{!isset($arrayscores[$item->id][$i]) ? '' : $arrayscores[$item->id][$i]}}</td>
                          @endfor
                          @if (isset($arraydetails))
                            @foreach ($avgs as $index => $item2)
                              <td style="text-align: center;">
                                @if(isset($arrayscores[$item->id]))
                                  @php
                                  $avg = collect(array_intersect_key($arrayscores[$item->id], $item2->toArray()))->filter(function($value, $key) { return $value >= 0 && isset($value); })->avg();
                                  print number_format($avg, 2, '.', ',');
                                  @endphp
                                @endif
                              </td>
                            @endforeach
                          @else
                            <td style="text-align: center;"></td>
                          @endif
                          @if ($avgs)
                            <?php $groupscores = array(); ?>
                            @foreach ($avgs as $index => $item2)
                              <td style="text-align: center;">
                                  @php
                                  if(isset($arraygroup_percentages[$index])) {
                                      if ($arrayscores[$item->id]) {
                                        //compare detail with score and get score with the same detail
                                        $avg = collect(array_intersect_key($arrayscores[$item->id], $item2->toArray()))->avg();
                                        $percent = $avg * $arraygroup_percentages[$index] * 0.01;
                                        print number_format($percent, 2, '.', ',');
                                        $groupscores[] = $percent;
                                      } else {

                                      }
                                  } else {
                                      if ($arrayscores[$item->id]) {
                                        //compare detail with score and get score with the same detail
                                        $avg = collect(array_intersect_key($arrayscores[$item->id], $item2->toArray()))->avg();
                                        print number_format($avg, 2, '.', ',');
                                      } else {

                                      }
                                  }
                                  @endphp
                              </td>
                            @endforeach
                          @else
                            <td></td>
                          @endif
                          @if ($group_avgs)
                            <?php $finals = array(); ?>
                            @foreach ($group_avgs as $index => $item3)
                              <td style="text-align: center;">
                                @php
                                    if (isset($groupscores)) {
                                      $groupscore_sums = collect(array_intersect_key($groupscores, $item3->toArray()))->sum();
                                      print number_format($groupscore_sums, 2, '.', ',');
                                      $finals[] = $groupscore_sums;
                                    }
                                @endphp
                              </td>
                            @endforeach
                          @else
                            <td></td>
                          @endif
                          @if ($group_avgs)
                            <td style="text-align: center;">
                              @php
                                $final = collect($finals)->sum();
                                $array_finals[] = $final;
                                print number_format($final, 2, '.', ',');
                              @endphp
                            </td>
                          @else
                            <td></td>
                          @endif
                          <td></td>
                          <?php $no++; ?>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          {{--box-body--}}
        </div>
    </div>
    {{--tab-pane--}}
  </div>
  {{--tab-content--}}
</div>
</div>
@include('gradings.scoringsheets._modal_columnscore')
@endsection

@section('scripts')
    @include('shared._part_notification')
    @include('gradings.scoringsheets._script_columnscore')
@endsection
