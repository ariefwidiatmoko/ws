@extends('layouts.dashboard')

@section('title', 'Setting detail score ' . $subject->subjectname)

@section('stylesheets')
  <style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 20px !important;
    }
  </style>
  @include('shared._part_select')
@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">Gradings</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('scoringsheets.index') }}">Scoring Sheets</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('scoringsheets.show', $classsubject->id) }}">Input Scoring</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
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
    <a href="{{ route('scoringsheets.show', $classsubject->id) }}" class="btn btn-xs btn-default">Back</a>
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
  <div class="row" style="margin-top: -20px;">
    <div class="col-md-12">
      <!-- Type Score -->
      <div class="box box-default">
        <div class="box-header" style="margin-left: 30px; margin-bottom: -18px;">
          <h3 class="box-title">@yield('button')</h3>
        </div>
        <hr>
        <div class="box-body box-profile" style="margin-bottom: 8px;">
          <form enctype="multipart/form-data" role="form" action="{{{route('scoringsheets.updatesettingscore', ['year_id' => $classsubject->year_id, 'semester_id' => $classsubject->semester_id, 'classroom_id' => $classsubject->classroom_id, 'subject_id' => $classsubject->subject_id])}}}" method="POST">
            {{ csrf_field() }}
            <!-- Typename -->
            <div class="form-group @if ($errors->has('type_id')) has-error @endif" style="margin-left: 15px; margin-right: 15px;">
              <label>Type Score</label>
              <select class="form-control select-setting" name="type_id" required>
                <option value="">Select Type Score</option>
                @foreach ($types as $item)
                  <option value="{{ $item->id }}">{{ $item->typename }}{{' - ' . $item->typedescription}}</option>
                @endforeach
              </select>
              @if ($errors->has('type_id')) <p class="help-block">{{ $errors->first('type_id') }}</p> @endif
            </div>
            <!-- Groupname -->
            <div class="form-group @if ($errors->has('group_id')) has-error @endif" style="margin-left: 15px; margin-right: 15px;">
              <label>Group Score</label>
              <select class="form-control select-setting" name="group_id" required>
                <option value="">Select Group Score</option>
                @foreach ($groups as $item)
                  <option value="{{ $item->id }}">{{ $item->groupname }}</option>
                @endforeach
              </select>
              @if ($errors->has('group_id')) <p class="help-block">{{ $errors->first('group_id') }}</p> @endif
            </div>
            <!-- Detailname -->
            <div class="form-group @if ($errors->has('detailname')) has-error @endif" style="margin-left: 15px; margin-right: 15px;">
              <label>Detail Score</label>
              <select class="form-control select-setting" name="detailname[]" multiple="multiple" required>
                <option value="">Multi-select Detail Score</option>
                @foreach ($details as $item)
                  <option value="{{ $item->id }}">{{ $item->detailname }}</option>
                @endforeach
              </select>
              @if ($errors->has('detailname')) <p class="help-block">{{ $errors->first('detailname') }}</p> @endif
            </div>
            <div class="box-footer" style="margin-top: 15px; margin-left: 5px;">
                <!-- Submit Form Button -->
                <button type="submit" class="btn btn-xs btn-success"  {{$result->isEmpty() == true ? 'disabled' : ''}}>Save</button>
                <!-- Back Button -->
                <a href="{{ route('scoringsheets.show', $classsubject->id) }}" type="button" class="btn btn-default btn-xs">Cancel</a>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  @if($result->count() > 0)
  <div class="row">
    <div class="col-md-12" style="margin-top: -20px;">
      <!-- Table Type Group Detail -->
      <div class="box box-default">
        <div class="box-body box-profile">
            <table id="inlist" class="table table-hover table-bordered">
              <thead>
                <tr>
                    <th style="text-align: center;"><i class="fa fa-chevron-circle-down"></i></th>
                    <th style="text-align: center;">Type Score</th>
                    <th style="text-align: center;"><i class="fa fa-chevron-circle-down"></i></th>
                    <th style="text-align: center;">Group Score</th>
                    <th style="text-align: center;"><i class="fa fa-chevron-circle-down"></i></th>
                    <th style="text-align: center;">Detail Score</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody>
                      @foreach ($result as $index => $item)
                        <tr>
                          <td style="text-align: center;">{{$index + $result->firstItem()}}</td>
                          <td style="text-align: center;">{{$item->typename}}</td>
                          <td></td>
                          <td style="text-align: center;">
                            <table>
                              <tbody>
                                @foreach ($result2 as $index => $item2)
                                  @if ($item->type_id == $item2->type_id)
                                    <tr>
                                      <td>{{$item2->groupname}}</td>
                                    </tr>
                                  @endif
                                @endforeach
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      @endforeach
                </tbody>
              </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    @endif
  </div>
</div>
@endsection

@section('scripts')
    @include('shared._part_notification')
    <!--select2-->
    <script src="{{ asset('src/select2/dist/js/select2.min.js') }}"></script>
    <script>
    $(".select-setting").select2();
    </script>
@endsection
