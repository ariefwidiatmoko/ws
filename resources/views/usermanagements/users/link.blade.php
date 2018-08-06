@extends('layouts.dashboard')

@section('title', 'Link to Employee')

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a>User Managements</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('users.index') }}">Users</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <div class="row">
    <div class="btn-group" role="group" style="margin-left: -10px;">
      <div class="col-xs-1 margin">
        <a href="{{ route('users.index') }}" class="btn btn-xs btn-default">Back</a>
      </div>
      <div class="col-xs-1 margin">
        {!! Form::open( ['method' => 'delete', 'url' => route('users.updateLink', $user->id), 'onSubmit' => 'return confirm("Are yous sure wanted to delete the link?")']) !!}
          {{ method_field('PUT') }}
          {{ csrf_field() }}
          <input type="hidden" name="employee_id" value="">
          <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash-o fa-fw"></i>Link</button>
        {!! Form::close() !!}
      </div>
    </div>
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
  <div class="box" style="margin-top: -20px;">
    <div class="box-header" style="margin-left: 16px; margin-bottom: -16px;">
      <h3 class="box-title">@yield('button')</h3>
    </div>
    <hr>
    <!-- /.box-header -->
    <div class="box-body" style="margin-left: 15px; margin-right: 15px;">
      <form enctype="multipart/form-data" role="form" action="{{ route('users.updateLink', $user->id) }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
          <!-- user_id -->
          <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">
          <input type="hidden" name="user_id" value="{{ $user->id }}">

          <!-- Link to employee -->
          <div class="form-group">
              <label>Link "{{ucwords($user->name)}}" to Employee</label>
              <select class="form-control" name="employee_id">
                @if (empty($user->employee_id))
                  <option value="">Select Employee</option>
                @endif
                @foreach ($employees as $item)
                  <option value="{{ $item->id }}" {{$user->employee_id == $item->id ? 'select' : ''}}>{{ ucwords($item->employeename) }}</option>
                @endforeach
              </select>
          </div>
          <div class="">
            <br>
            <!-- Submit Form Button -->
            {!! Form::submit('Save', ['class' => 'btn btn-xs btn-success']) !!}
            <!-- Back Button -->
            <a href="{{ route('users.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
          </div>
        </form>
    </div>
    <!-- /.box-body -->
  </div>
</div>
@endsection

@section('scripts')
    @include('shared._part_notification')
@endsection
