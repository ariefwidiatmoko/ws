@extends('layouts.dashboard')

@section('title', ucwords($subject->subjectname) . ' - Grade ' . $grade->gradename . ' | ' . $year->yearname . ' | created by : ' . ucwords($competencyfirst->created_by))

@section('stylesheets')
  <style media="screen">
      .table-competency {
        font-size: 14px;
      }
      .boldh {
        font-weight: bold;
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
      <li class="pull-right"><a href="#" class=""><i class="fa fa-upload" title="Import CSV"></i></a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active">
        <div id="inlist" class="table-responsive box-body">
          <div class="row">
            <div class="col-sm-12">
              <table id="inlist" class="table table-hover">
                <thead>
                  <tr>
                    <th class="table-competency text-center"><i class="fa fa-th"></i></th>
                    <th class="table-competency">Scale</th>
                    <th class="table-competency">Description</th>
                    <th class="table-competency text-center">Action</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody>
                  <tr>
                    <td class="table-competency"></td>
                    <td class="table-competency" colspan="3"><b>Semester 1</b></td>
                  </tr>
                  {{--Semester 1 Competency--}}
                  @if (!empty(array_filter($semester1)))
                    @for($i = 0; $i < count($semester1); $i++)
                  <tr>
                    {{--Head Competency--}}
                    <td class="table-competency boldh text-center">{{$i+1}}</td>
                    <td class="table-competency boldh">KD {{$kd->id}}.{{$i+1}}</td>
                    <td class="table-competency boldh" id="head-sem-1-{{$i}}" contenteditable="false">{{ucfirst($semesterh1[$i])}}</td>
                    <td class="table-competency text-center">
                      {{--Edit Button Sem1--}}
                      <button class="edit-head btn btn-xs btn-info"
                              data-btn-edit="Edit-head-{{$i}}"
                              data-btn-save="Save-head-{{$i}}"
                              data-comp-id="head-sem-1-{{$i}}"
                              id="Edit-head-{{$i}}">Edit
                      </button>
                      {{--Save Button Sem1--}}
                      <button class="save-head btn btn-xs btn-info"
                              data-btn-edit="Edit-head-{{$i}}"
                              data-btn-save="Save-head-{{$i}}"
                              data-comp-id="head-sem-1-{{$i}}"
                              data-id="{{$semesterId1->id}}"
                              data-index="{{$i}}"
                              data-array-index="{{$i}}"
                              id="Save-head-{{$i}}">Save
                      </button>
                    </td>
                  </tr>
                      @for ($j = 0; $j < count($semester1[$i]); $j++)
                  <tr>
                    {{--Detail Competency--}}
                    <td class="table-competency text-center"><i class="fa fa-minus-square-o"></i></td>
                    <td class="table-competency">{{$alphascores[$j][0]}} < {{$alphas[$j]}} &le; {{$alphascores[$j][1]}}</td>
                    <td class="table-competency" id="detail-sem-1-{{$i}}" contenteditable="false">{{empty($semester1[$i][$j]) ? '' : ucfirst($semester1[$i][$j])}}</td>
                    <td class="table-competency text-center">
                      <button class="edit-detail btn btn-xs btn-default"
                              data-btn-edit="Edit-detail-{{$i}}-{{$j}}"
                              data-btn-save="Save-detail-{{$i}}-{{$j}}"
                              data-comp-id="detail-sem-1-{{$i}}-{{$j}}"
                              id="Edit-detail-{{$i}}-{{$j}}">Edit
                      </button>
                      <button class="save-detail btn btn-xs btn-default"
                              data-btn-edit="Edit-detail-{{$i}}-{{$j}}"
                              data-btn-save="Save-detail-{{$i}}-{{$j}}"
                              data-comp-id="detail-sem-1-{{$i}}-{{$j}}"
                              data-id="{{$semesterId1->id}}"
                              data-index1="{{$i}}"
                              data-index2="{{$j}}"
                              data-array-index="{{$i}}"
                              id="Save-detail-{{$i}}-{{$j}}">Save
                      </button>
                    </td>
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
                    <td class="table-competency boldh" colspan="3">Semester 2</td>
                  </tr>
                  {{--Semester 2 Competency--}}
                  @if (!empty(array_filter($semester2)))
                    @for($i = 0; $i < count($semester2); $i++)
                  <tr>
                    {{--Head Competency--}}
                    <td class="table-competency boldh text-center">{{count($semester1)+$i+1}}</td>
                    <td class="table-competency boldh">KD {{$kd->id}}.{{count($semester1)+$i+1}}</td>
                    <td class="table-competency boldh" contenteditable="false">{{ucfirst($semesterh2[$i])}}</td>
                    <td class="table-competency text-center"><button class="btn btn-xs btn-info" id="head-sem-2-{{$i}}">Edit</button></td>
                  </tr>
                      @for ($j = 0; $j < count($semester2[$i]); $j++)
                  <tr>
                    {{--Detail Competency--}}
                    <td class="table-competency text-center"><i class="fa fa-minus-square-o"></i></td>
                    <td class="table-competency">{{$alphascores[$j][0]}} < {{$alphas[$j]}} &le; {{$alphascores[$j][1]}}</td>
                    <td class="table-competency" contenteditable="false">{{empty($semester2[$i][$j]) ? '' : ucfirst($semester2[$i][$j])}}</td>
                    <td class="table-competency text-center"><button class="btn btn-xs btn-default" id="detail-sem-2-{{$i}}-{{$j}}">Edit</button></td>
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
        <!-- /.box-body -->
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
            $(".save-head").hide();
            $(".save-detail").hide();
            {{--Edit Head Competency--}}
            $(document).on('click', '.edit-head', function() {
                var compId = $(this).data('comp-id');
                var btnEdit = $(this).data('btn-edit');
                var btnSave = $(this).data('btn-save');
                var name = $("#"+compId).html();
                $("#"+compId).attr("contenteditable", true);
                $("#"+compId).focus();
                $("#"+btnEdit).hide();
                $("#"+btnSave).show();
            });
            $(document).on('click', '.save-head', function() {
                var btnEdit = $(this).data('btn-edit');
                var btnSave = $(this).data('btn-save');
                var id = $(this).data('id');
                var index = $(this).data('index');
                var compId = $(this).data('comp-id');
                var dataComp = $("#"+compId).html();
                $("#"+compId).attr("contenteditable", false);
                $("#"+btnEdit).show();
                $("#"+btnSave).hide();

                $.ajax({
                   type: 'POST',
                   url:"{{ URL::route('competencies.updatecompetency')}}",
                   data: {
                     '_token': $('input[name=_token]').val(),
                     'id': id,
                     'index': index,
                     'competency' :dataComp,
                   },
                });
            });
            {{--Edit Detail Competency--}}
            $(document).on('click', '.edit-detail', function() {
                var compId = $(this).data('comp-id');
                var btnEdit = $(this).data('btn-edit');
                var btnSave = $(this).data('btn-save');
                var name = $("#"+compId).html();
                $("#"+compId).attr("contenteditable", true);
                $("#"+compId).focus();
                $("#"+btnEdit).hide();
                $("#"+btnSave).show();
            });
        });
    </script>
@endsection
