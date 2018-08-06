@extends('layouts.dashboard')

@section('title')
<small class="label bg-aqua">{{ucwords($subject->subjectname)}}</small> | <small class="label bg-aqua">Grade {{$grade->gradename}}</small> | <small class="label bg-aqua">{{$year->yearname}}</small> | <small class="label bg-aqua">created by : {{ucwords($competencyfirst->created_by)}}</small>
@endsection

@section('stylesheets')
  <style media="screen">
      .table-competency {
        font-size: 14px;
      }
      .boldh {
        font-weight: bold;
      }
      i.icon {
        font-size: 16px;
      }
      button.btn-icon {
        border: none;
        outline: none;
        background: none;
        cursor: pointer;
        padding: 0;
      }
  </style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Gradings</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a href="{{route('competencies.index')}}">Competencies</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Show</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection
  @include('gradings.scoringsheets._style_scoringsheet')

@section('button')
  <div class="row">
    <a href="{{route('competencies.index')}}" title="Back" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i></a>
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
    <ul class="nav nav-tabs">
      <li class="{{ Request::is('home/gradings/competencies/show/3/*') ? 'active' : '' }}"><a href="{{route('competencies.show', [$peng->id, $competencyfirst->batch_id])}}">{{$peng->typedescription}}</a></li>
      <li class="{{ Request::is('home/gradings/competencies/show/4/*') ? 'active' : '' }}"><a href="{{route('competencies.show', [$ketr->id, $competencyfirst->batch_id])}}">{{$ketr->typedescription}}</a></li>
      <li class="pull-right">
        <div class="row" style="margin: 10px;">
          {!! Form::open( ['method' => 'delete', 'url' => route('competencies.destroy', $competencyfirst->subjectgradeyear_id), 'onSubmit' => 'return confirm("Are you sure you want to delete it?")']) !!}
            <button type="submit" class="btn-icon" style="color: red;"><i class="fa fa-trash-o fa-fw icon" title="Delete Competency" style="font-size: 18px;"></i></button>
          {!! Form::close() !!}
        </div>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active">
        <div class="box-header" style="margin-left: 13px;">
          <h3 class="box-title">@yield('button')</h3>
        </div>
        <div id="inlist" class="table-responsive box-body">
          <div class="row">
            <div class="col-sm-12">
              <table id="inlist" class="table table-hover">
                <thead>
                  <tr>
                    <th class="table-competency text-center"><i class="fa fa-th"></i></th>
                    <th class="table-competency">Scale</th>
                    <th class="table-competency">Description</th>
                    <th class="table-competency text-center">
                      {{--Edit/Save Scale--}}
                      <button class="btn btn-xs btn-success" id="edit-scale" data-focus-id="scale-sem-{{$semesterId1->id}}-0-0" data-btn-edit="edit-scale" data-btn-save="save-scale"><i class="fa fa-pencil fa-fw"></i>Scale</button>
                      <button class="save-scale btn btn-xs btn-success" id="save-scale"><i class="fa fa-save fa-fw"></i>Scale</button>
                      {{--Edit/Save Head--}}
                      <button class="btn btn-xs btn-info margin" id="edit-head" data-focus-id="head-sem-{{$semesterId1->id}}-0" data-btn-edit="edit-head" data-btn-save="save-head"><i class="fa fa-pencil fa-fw"></i>Head</button>
                      <button class="save-head btn btn-xs btn-info margin" id="save-head"><i class="fa fa-save fa-fw"></i>Head</button>
                      {{--Edit/Save Detail--}}
                      <button class="btn btn-xs btn-default" id="edit-detail" data-focus-id="detail-sem-{{$semesterId1->id}}-0-0" data-btn-edit="edit-detail" data-btn-save="save-detail"><i class="fa fa-pencil fa-fw"></i>Detail</button>
                      <button class="save-detail btn btn-xs btn-default" id="save-detail"><i class="fa fa-save fa-fw"></i>Detail</button>
                    </th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody>
                  <tr>
                    <td class="table-competency"></td>
                    <td class="table-competency"></td>
                    <td class="table-competency boldh">Semester 1</td>
                    <td class="table-competency text-center">
                    </td>
                  </tr>
                  {{--Semester 1 Competency--}}
                  @if (!empty(array_filter($semester1)))
                    @for($i = 0; $i < count($semester1); $i++)
                  <tr>
                    {{--Head Competency--}}
                    <td class="table-competency boldh text-center">{{$i+1}}</td>
                    <td class="table-competency boldh">KD {{$kd->id}}.{{$i+1}}</td>
                    <td class="edit-head table-competency boldh" id="head-sem-{{$semesterId1->id}}-{{$i}}" contenteditable="false" colspan="2" onblur="updatehead({{$semesterId1->id}},{{$i}})">{{ucfirst($semesterh1[$i])}}</td>
                  </tr>
                      @for ($j = 0; $j < count($semester1[$i]); $j++)
                  <tr>
                    {{--Detail Competency--}}
                    <td class="table-competency text-center"><i class="fa fa-minus-square-o"></i></td>
                    <td class="show-scale table-competency">{{empty($semesterscale1[$i][$j][0]) ? 0 : $semesterscale1[$i][$j][0]}} < {{$alphas[$j]}} &le; {{empty($semesterscale1[$i][$j][1]) ? 0 : $semesterscale1[$i][$j][1]}}</td>
                    <td class="edit-scale table-competency" id="scale-sem-{{$semesterId1->id}}-{{$i}}-{{$j}}" contenteditable="false" onblur="updatescale({{$semesterId1->id}},{{$i}},{{$j}})">{{empty($semesterscale1[$i][$j][0]) ? 0 : $semesterscale1[$i][$j][0]}};{{empty($semesterscale1[$i][$j][1]) ? 0 : $semesterscale1[$i][$j][1]}}</td>
                    <td class="edit-detail table-competency" id="detail-sem-{{$semesterId1->id}}-{{$i}}-{{$j}}" contenteditable="false" colspan="2" onblur="updatedetail({{$semesterId1->id}},{{$i}},{{$j}})">{{empty($semester1[$i][$j]) ? '' : ucfirst($semester1[$i][$j])}}</td>
                  </tr>
                      @endfor
                    @endfor
                  @else
                  <tr>
                    <td class="table-competency" colspan="4">No Data</td>
                  </tr>
                  @endif
                  <tr>
                    <td class="table-competency"></td>
                    <td class="table-competency"></td>
                    <td class="table-competency boldh" colspan="3">Semester 2</td>
                    <td class="table-competency"></td>
                  </tr>
                  {{--Semester 2 Competency--}}
                  @if (!empty(array_filter($semester2)))
                    @for($i = 0; $i < count($semester2); $i++)
                  <tr>
                    {{--Head Competency--}}
                    <td class="table-competency boldh text-center">{{count($semester1)+$i+1}}</td>
                    <td class="table-competency boldh">KD {{$kd->id}}.{{count($semester1)+$i+1}}</td>
                    <td class="edit-head table-competency boldh" id="head-sem-{{$semesterId2->id}}-{{$i}}" contenteditable="false" colspan="2" onblur="updatehead({{$semesterId2->id}},{{$i}})">{{ucfirst($semesterh2[$i])}}</td>
                  </tr>
                      @for ($j = 0; $j < count($semester2[$i]); $j++)
                  <tr>
                    {{--Detail Competency--}}
                    <td class="table-competency text-center"><i class="fa fa-minus-square-o"></i></td>
                    <td class="show-scale table-competency">{{empty($semesterscale2[$i][$j][0]) ? 0 : $semesterscale2[$i][$j][0]}} < {{$alphas[$j]}} &le; {{empty($semesterscale2[$i][$j][1]) ? 0 : $semesterscale2[$i][$j][1]}}</td>
                    <td class="edit-scale table-competency" id="scale-sem-{{$semesterId2->id}}-{{$i}}-{{$j}}" contenteditable="false" onblur="updatescale({{$semesterId2->id}},{{$i}},{{$j}})">{{empty($semesterscale2[$i][$j][0]) ? 0 : $semesterscale2[$i][$j][0]}};{{empty($semesterscale2[$i][$j][1]) ? 0 : $semesterscale2[$i][$j][1]}}</td>
                    <td class="edit-detail table-competency" id="detail-sem-{{$semesterId2->id}}-{{$i}}-{{$j}}" contenteditable="false" colspan="2" onblur="updatedetail({{$semesterId2->id}},{{$i}},{{$j}})">{{empty($semester2[$i][$j]) ? '' : ucfirst($semester2[$i][$j])}}</td>
                  </tr>
                      @endfor
                    @endfor
                  @else
                  <tr>
                    <td class="table-competency" colspan="4">No Data</td>
                  </tr>
                  @endif
                </tbody>
              </table>
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
@endsection

@section('scripts')
    @include('shared._part_notification')
    <script>
        {{--Enable/Disable contenteditable--}}
        $(document).ready(function(){
            $(".edit-scale").hide();
            $(".save-scale").hide();
            $(".save-head").hide();
            $(".save-detail").hide();
            {{--Edit Scale Competency--}}
            $(document).on('click', '#edit-scale', function() {
                var focusId = $(this).data('focus-id');
                var btnEdit = $(this).data('btn-edit');
                var btnSave = $(this).data('btn-save');
                $(".edit-scale").attr("contenteditable", true);
                $(".edit-scale").attr("style", "background-color: #00a65a29;");
                $("#"+focusId).focus();
                $(".edit-scale").show();
                $(".show-scale").hide();
                $("#"+btnEdit).hide();
                $("#"+btnSave).show();
            });
            $(document).on('click', '#save-scale', function() {
                window.location.reload();
            });
            {{--Edit Head Competency--}}
            $(document).on('click', '#edit-head', function() {
                var focusId = $(this).data('focus-id');
                var btnEdit = $(this).data('btn-edit');
                var btnSave = $(this).data('btn-save');
                $(".edit-head").attr("contenteditable", true);
                $(".edit-head").attr("style", "background-color: #00c0ef1c;");
                $("#"+focusId).focus();
                $("#"+btnEdit).hide();
                $("#"+btnSave).show();
            });
            $(document).on('click', '#save-head', function() {
                window.location.reload();
            });
            {{--Edit Detail Competency--}}
            $(document).on('click', '#edit-detail', function() {
                var focusId = $(this).data('focus-id');
                var btnEdit = $(this).data('btn-edit');
                var btnSave = $(this).data('btn-save');
                $(".edit-detail").attr("contenteditable", true);
                $(".edit-detail").attr("style", "background-color: #f4f4f4;");
                $("#"+focusId).focus();
                $("#"+btnEdit).hide();
                $("#"+btnSave).show();
            });
            $(document).on('click', '#save-detail', function() {
                window.location.reload();
            });
        });
        {{--Update Scale Competency--}}
        function updatescale(id,index1,index2) {
          var scaleComp = $("#scale-sem-"+id+"-"+index1+"-"+index2).html();

          $.ajax({
            type: 'POST',
            url:"{{ URL::route('competencies.updatescale')}}",
            data: {
              '_token': $('input[name=_token]').val(),
              'id': id,
              'index1': index1,
              'index2': index2,
              'scalecomp' : scaleComp,
            },
          });
        }
        {{--Update Head Competency--}}
        function updatehead(id,index) {
          var headComp = $("#head-sem-"+id+"-"+index).html();

          $.ajax({
            type: 'POST',
            url:"{{ URL::route('competencies.updatehead')}}",
            data: {
              '_token': $('input[name=_token]').val(),
              'id': id,
              'index': index,
              'headcomp' : headComp,
            },
          });
        }
        {{--Update Detail Competency--}}
        function updatedetail(id,index1,index2) {
          var detailComp = $("#detail-sem-"+id+"-"+index1+"-"+index2).html();

          $.ajax({
            type: 'POST',
            url:"{{ URL::route('competencies.updatedetail')}}",
            data: {
              '_token': $('input[name=_token]').val(),
              'id': id,
              'index1': index1,
              'index2': index2,
              'detailcomp' : detailComp,
            },
          });
        }
    </script>
@endsection
