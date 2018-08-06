<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Export Scoring Sheet</title>
    <style>
      th {
        text-align: center;
        width: 8;
        height: 20;
        white-space:nowrap;
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
        vertical-align: middle;
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
          <td class="title" colspan="7">Competency Sheet</td>
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
          <th colspan="3">Competency</th>
            {{-- Display Compentency Detail, Check if Column Score already set minimum 1 --}}
            @if (count($avgs) > 0)
              {{-- Display Compentency Detail --}}
              @for ($ar = 0; $ar < count($avgs); $ar++)
                <th colspan="{{count($avgs[$ar])}}">{!! !isset($avgs[$ar]) ? 'KD-3.?' : 'KD-' . $type->id . '.' . (1 + $ar) !!}</th>
              @endfor
            @else
              <th colspan="1">KD-3.?</th>
            @endif
            {{-- Display Head Column Average --}}
            <th colspan="{{count($avgs) == 0 ? 1 : count($avgs)}}">Average</th>
            {{-- Display Alphabet Grading --}}
            <th colspan="{{count($avgs) == 0 ? 1 : count($avgs)}}">Alphabet</th>
            <th rowspan="2" style="width: 65;">Description</th>
        </tr>
        <tr>
            <th class="th-4">No</th>
            <th>No ID</th>
            <th class="th-20">Student</th>
          {{-- Display Detail Column --}}
          @if (isset($avgs))
            @for ($i = 0; $i < count($avgs); $i++)
              @forelse($avgs[$i] as $index => $item)
              <th>{{!isset($arraydetails[$index]) ? '' : $arraydetails[$index]}}</th>
              @empty
                <th></th>
              @endforelse
            @endfor
          @endif
          {{-- Display Sub Average Detail Score --}}
          @if (count($avgs) > 0)
            @for ($ar = 0; $ar < count($avgs); $ar++)
              <th>{!! !isset($avgs[$ar]) ? 'KD-3.?' : 'KD-' . $type->id . '.' . (1 + $ar) !!}</th>
            @endfor
          @else
            <th></th>
          @endif
          {{-- Display Sub Alphabet Grade --}}
          @if (count($avgs) > 0)
            @for ($ar = 0; $ar < count($avgs); $ar++)
              <th>{!! !isset($avgs[$ar]) ? '' : 'KD-' . $type->id . '.' . (1 + $ar) !!}</th>
            @endfor
          @else
            <th>KD-3.?</th>
          @endif
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        @foreach ($result as $index => $item)
          <tr>
            <td>{{$no}}</td>
            <td>{{$item->noId}}</td>
            <td>{{$item->studentname}}</td>
            @foreach ($avgs as $index2 => $item2)
              @foreach ($avgs[$index2] as $index3 => $item3)
                <td>{{!isset($arrayscores[$item->id][$index3]) ? '' : $arrayscores[$item->id][$index3]}}</td>
              @endforeach
            @endforeach
            @for ($i=0; $i < count($uniques); $i++)
              <td>{{$array_average[$index][$i]}}</td>
            @endfor
            @for ($i=0; $i < count($uniques); $i++)
              <td>{{$array_grade[$index][$i]}}</td>
            @endfor
            @php $row_excel = ceil(strlen($array_description[0]) / 65); @endphp
            <td style="height: {{$row_excel * 18}}">{{$array_description[$index]}}</td>
            <?php $no++; ?>
          </tr>
        @endforeach
      </tbody>
      </table>
  </body>
</html>
