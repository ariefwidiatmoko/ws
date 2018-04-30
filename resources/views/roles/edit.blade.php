@extends('layouts.dashboard')

@section('title', 'Edit Role')

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('roles.index') }}">Roles</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('roles.index') }}" class="btn btn-xs btn-default">Back</a>
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
    <div class="box-header" style="margin-left: 16px; margin-bottom: -16px;">
      <h3 class="box-title">@yield('button')</h3>
    </div>
    <hr>
    <!-- /.box-header -->
    <div class="box-body" style="margin-left: 15px; margin-right: 15px;">
      <form enctype="multipart/form-data" role="form" action="{{ route('roles.update', $role->id) }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="">
              @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                @if($role->name === 'Admin')
                  @include('roles._permissions', [
                           'title' => $role->name,
                           'options' => [''] ])
                @else
                @include('roles._permissions', [
                         'title' => $role->name,
                         'model' => $role ])
              @endif
            </div>
            <div class="box-footer">
              <!-- Submit Form Button -->
              {!! Form::submit('Save', ['class' => 'btn btn-xs btn-success']) !!}
              <!-- Back Button -->
              <a href="{{ route('roles.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
@endsection
