@extends('layouts.dashboard')

@section('title', 'Import Excel')

@section('part_stylesheets')
 style="margin-top: -33px !Important;"
@endsection

@section('stylesheets')
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('src/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> }}">
@endsection

@section('navmenu')
  <li><a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i> Dashboard</a></li>
  <li class="active">@yield('title')</li>
@endsection

@section('content')
  <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CSV Import</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('importcsv.studentsSave') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">CSV file to Upload</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control" name="file" required>

                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button class="btn btn-xs
                                    btn-primary">
                                        Upload
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
