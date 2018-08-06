<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Export Scoring Sheet</title>
    <style>
      th {
        text-align: center;
        width: 7;
        height: 20;
      }
      .th-4 {
        width: 4;
      }
      .th-10 {
        width: 10;
      }
      .th-20 {
        width: 20;
      }
      td {
        height: 18;
      }
      .title {
        text-align: left;
        font-weight: 500;
        vertical-align: middle;
      }
      th {
          border: 1px solid #333;
      }
      td {
          border: 1px solid #333;
      }
    </style>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <td class="title" colspan="7">Scoring Sheet</td>
        </tr>
        <tr>
          <td class="title" colspan="2">Subject</td>
          <td class="title" colspan="5">{{$subject->subjectname}} - {{$classroom->classroomname}}</td>
        </tr>
        <tr>
          <td class="title" colspan="2">Year</td>
          <td class="title" colspan="5">{{$year->yearname}} - {{$semester->semestername}}</td>
        </tr>
        <tr>
          <br>
        </tr>
        <tr>
            <th class="border" colspan="3">Competency</th>
              {{-- Display Compentency Detail, Check if Column Score already set minimum 1 --}}
              @if (count($arraydetails) > 0)
                {{-- Display Compentency Detail that has/can been set --}}
                @for ($ar = 0; $ar < count($arraydetails); $ar++)
                  <th colspan="1">{!! !isset($arraycompetencies[$ar]) ? '...' : 'KD ' . $type->id . '.' . (1 + $arraycompetencies[$ar]) !!}</th>
                @endfor
                {{-- Display Competency Detail that is still disabled/empty --}}
                @for ($i = count($arraydetails); $i < $setscore->columnscore; $i++)
                  <th colspan="1">...</th>
                @endfor
              @else
                {{-- Display All Competency Detail that is still disabled/empty --}}
                @for ($i = 0; $i < $setscore->columnscore; $i++)
                  <th colspan="1">...</th>
                @endfor
              @endif
              {{-- Display Head Column Average --}}
              <th colspan="{{count($uniques) == 0 ? 1 : count($uniques)}}">Average</th>
              {{-- Display Group Detail & Percent Detail --}}
              @if (count($arraygroups) > 0)
                @for ($ar = 0; $ar < count($arraygroups); $ar++)
                  <th colspan="1">{{!isset($arraygroup_percentages[$ar]) ? '...' : $arraygroup_percentages[$ar].'%'}} {{!isset($arraygroups[$ar]) ? '' : $group_ids[$arraygroups[$ar]]}}</th>
                @endfor
                @for ($ar = count($arraygroups); $ar < count($uniques); $ar++)
                  <th colspan="1">...</th>
                @endfor
              @else
                @foreach ($uniques as $index => $i)
                  <th colspan="1">...</th>
                @endforeach
              @endif
              <th colspan="{{count($group_uniques) == 0 ? 1 : count($group_uniques)}}">Group Score</th>
              <th rowspan="2">Final</th>
              <th rowspan="2">Grade</th>
          </tr>
          <tr>
              <th class="th-4">No</th>
              <th>No ID</th>
              <th class="th-20">Student</th>
            {{-- Display Detail Column, Check if Detail Column has been set, min 1 --}}
            @if (isset($arraydetails))
              {{-- Display Detail Column, that has been set, min 1 --}}
              @for ($ar = 0; $ar < count($arraydetails); $ar++)
                <th>{{!isset($arraydetails[$ar]) ? '' : $arraydetails[$ar]}}</th>
              @endfor
              {{-- Display Detail Column, that is still disabled/empty --}}
              @for ($i = count($arraydetails); $i < $setscore->columnscore; $i++)
                <th class="th-4">{{$i+1}}</th>
              @endfor
            @else
              {{-- Display All Detail Column, that is still disabled/empty --}}
              @for ($i = 0; $i < $setscore->columnscore; $i++)
                <th class="th-4">{{$i+1}}</th>
              @endfor
            @endif
            {{-- Display Sub Average Detail Score --}}
            @if (count($arraydetails) > 0)
              @foreach ($uniques as $i)
              <th>{{$detail_avgs[$i]}}</th>
              @endforeach
            @else
              <th></th>
            @endif
            {{-- Display Group Detail Score --}}
            @foreach ($uniques as $i)
              <th class="th-10">{{$detail_avgs[$i]}}</th>
            @endforeach
            @foreach ($group_uniques as $i)
              <th>{{$group_ids[$i]}}</th>
            @endforeach
          </tr>
          {{ csrf_field() }}
        </thead>
        <?php $array_finals = array(); ?>
        <tbody>
          <?php $no = 1; ?>
          @foreach ($result as $index => $item)
            <tr>
              <td>{{$no}}</td>
              <td>{{$item->noId}}</td>
              <td>{{$item->studentname}}</td>
              @for ($i = 0; $i < $setscore->columnscore; $i++)
                <td>{{!isset($arrayscores[$item->id][$i]) ? '' : $arrayscores[$item->id][$i]}}</td>
              @endfor
              @if (isset($arraydetails))
                @foreach ($avgs as $index => $item2)
                  <td>
                    @if(isset($arrayscores[$item->id]))
                      @php
                      $avg = collect(array_intersect_key($arrayscores[$item->id], $item2->toArray()))->filter(function($value, $key) { return $value >= 0 && isset($value); })->avg();
                      print number_format($avg, 2, '.', ',');
                      @endphp
                    @endif
                  </td>
                @endforeach
              @else
                <td></td>
              @endif
              @if ($avgs)
                <?php $groupscores = array(); ?>
                @foreach ($avgs as $index => $item2)
                  <td>
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
                  <td>
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
                <td>
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
  </body>
</html>
