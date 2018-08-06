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
  <a class="active">Show Competency {{ucfirst($peng->typedescription)}}</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')
  <div class="row">
    <a href="{{route('scoringsheets.showscore', [$peng->id, $classsubject->csbatch_id])}}" title="Back" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i></a>
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
    <li class=""><a href="{{route('scoringsheets.inputscore', [$peng->id, $classsubject->csbatch_id])}}">{{$peng->typedescription}}</a></li>
    <li class="active"><a href="{{route('scoringsheets.showcompetency', [$peng->id, $classsubject->csbatch_id])}}">KD {{$peng->typedescription}}</a></li>
    <li class="pull-right">
      <div class="row" style="margin: 10px;">
        <a href="#" title="Download Excel"><i class="fa fa-download fa-fw icon"></i></a>
        <a href="#" data-csbatch_id="{{$setscore->csbatch_id}}" data-type_id="{{$peng->id}}" class="column-score-modal" title="Setting"><i class="fa fa-gear icon"></i></a>
      </div>
    </li>
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
                          @if (count($avgs) > 0)
                            {{-- Display Compentency Detail --}}
                            @for ($ar = 0; $ar < count($avgs); $ar++)
                              <th style="text-align: center;" colspan="{{count($avgs[$ar])}}">
                                <a class="btn btn-xs" href="#" style="color: black;"><b>{!! !isset($avgs[$ar]) ? 'KD 3.?' : 'KD ' . $peng->id . '.' . (1 + $ar) !!}</b></a>
                              </th>
                            @endfor
                          @else
                            <th style="text-align: center;" colspan="1"><a class="btn btn-xs" href="#" style="color: grey; text-decoration: none;"></a></th>
                          @endif
                          {{-- Display Head Column Average --}}
                          <th style="text-align: center;" colspan="{{count($avgs) == 0 ? 1 : count($avgs)}}">Average</th>
                          {{-- Display Alphabet Grading --}}
                          <th style="text-align: center;" colspan="{{count($avgs) == 0 ? 1 : count($avgs)}}">Alphabet</th>
                          <th style="text-align: center; vertical-align: middle;" rowspan="2">Description</th>
                      </tr>
                      <tr>
                          <th class="fixed-side" style="text-align: center; vertical-align: middle;">No</th>
                          <th class="fixed-side" style="text-align: center; vertical-align: middle;">No ID</th>
                          <th class="fixed-side" scope="col" style="text-align: right; vertical-align: middle;">Student</th>
                        {{-- Display Detail Column --}}
                        @if (isset($avgs))
                          @for ($i = 0; $i < count($avgs); $i++)
                            @foreach($avgs[$i] as $index => $item)
                            <th style="text-align: center;">
                              <a class="btn btn-xs" style="color: black;"><b>{{!isset($arraydetails[$index]) ? '' : $arraydetails[$index]}}</b></a>
                            </th>
                            @endforeach
                          @endfor
                        @endif
                        {{-- Display Sub Average Detail Score --}}
                        @if (count($avgs) > 0)
                          @for ($ar = 0; $ar < count($avgs); $ar++)
                            <th style="text-align: center;">
                              <a class="btn btn-xs" href="#" style="color: black;"><b>{!! !isset($avgs[$ar]) ? 'KD 3.?' : 'KD ' . $peng->id . '.' . (1 + $ar) !!}</b></a>
                            </th>
                          @endfor
                        @else
                          <th style="text-align: center;" colspan="1"><a class="btn btn-xs" href="#" style="color: grey; text-decoration: none;"></a></th>
                        @endif
                        {{-- Display Sub Alphabet Grade --}}
                        @if (count($avgs) > 0)
                          @for ($ar = 0; $ar < count($avgs); $ar++)
                            <th style="text-align: center;">
                              <a class="btn btn-xs" href="#" style="color: black;"><b>{!! !isset($avgs[$ar]) ? 'KD 3.?' : 'KD ' . $peng->id . '.' . (1 + $ar) !!}</b></a>
                            </th>
                          @endfor
                        @else
                          <th style="text-align: center;" colspan="1"><a class="btn btn-xs" href="#" style="color: grey; text-decoration: none;"></a></th>
                        @endif
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
                          @foreach ($avgs as $index2 => $item2)
                            @foreach ($avgs[$index2] as $index3 => $item3)
                              <td style="text-align: center;">{{!isset($arrayscores[$item->id][$index3]) ? '' : $arrayscores[$item->id][$index3]}}</td>
                            @endforeach
                          @endforeach
                          @php $array_avg = array(); @endphp
                          @if (isset($uniques))
                            {{-- Average Competency --}}
                            @foreach ($avgs as $index2 => $item2)
                              <td style="text-align: center;">
                                @if(isset($arrayscores[$item->id]))
                                  @php
                                  $avg = collect(array_intersect_key($arrayscores[$item->id], $item2->toArray()))->filter(function($value, $key) { return $value >= 0 && isset($value); })->avg();
                                  print number_format($avg, 2, '.', ',');
                                  $array_avg[] = $avg;
                                  @endphp
                                @endif
                              </td>
                            @endforeach
                            {{-- Alphabet Grade --}}
                            @foreach ($array_avg as $ik => $itemk)
                              <td style="text-align: center;">
                                @php
                                  foreach ($arrayscales[$ik] as $il => $iteml) {
                                    if ($iteml[0] < $itemk && $iteml[1] >= $itemk) {
                                      echo $array_alphabet[$il];
                                    }
                                  }
                                @endphp
                              </td>
                            @endforeach
                          @else
                            <td style="text-align: center;"></td>
                          @endif
                          <td>
                            @php
                              echo ucfirst($item->studentnick) . " ";
                              foreach ($array_avg as $index1 => $item1) {
                                  foreach ($arrayscales[$index1] as $index2 => $item2) {
                                    if ($item2[0] < $item1 && $item2[1] >= $item1) {
                                      echo $arrayalphabets[$index1][$index2];
                                      if (count($array_avg) == ($index1 + 1)) {
                                          echo ".";
                                      } else {
                                          echo ", Ia ";
                                      }
                                    }
                                  }
                              }
                            @endphp
                          </td>
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
