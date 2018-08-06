@extends('layouts.dashboard')

@section('title', 'New Scoring Sheet')

@section('stylesheets')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('src/select2/dist/css/select2.min.css') }}">
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
  <style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
      color: white;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc;
        border: 1px solid #3c8dbc;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-right: 10px;
        line-height: 20px;
    }
  </style>
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('scoringsheets.index') }}">Scoring Sheets</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
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
  <div class="box" style="margin-top: -20px;">
    <!-- /.box-header -->
    <div class="box-body" style="margin-left: 15px; margin-right: 15px;">
      <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('scoringsheets.store') }}" method="POST">
        {{ csrf_field() }}
        @include('scorings.scoringsheets._form_create')
        <div class="box-footer">
            <!-- Submit Form Button -->
            {!! Form::submit('Save', ['class' => 'btn btn-xs btn-success']) !!}
            <!-- Back Button -->
            <a href="{{ route('scoringsheets.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
</div>
@endsection

@section('scripts')
  <script src="{{ asset('src/select2/dist/js/select2.min.js') }}"></script>
  @include('shared._part_notification')
  <script>
      $(function() {
          //Initialize Select2 Elements
          $("#select-classroom").select2();
          $("#select-subject").select2();
      });
  </script>
@endsection
