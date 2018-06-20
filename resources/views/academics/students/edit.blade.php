@extends('layouts.dashboard')

@section('title', 'Edit Student')

@section('stylesheets')
  <!-- icheck checkboxes -->
  <link rel="stylesheet" href="/src/iCheck/square/yellow.css">
  <!-- toastr notifications -->
  <link rel="stylesheet" href="/src/toastrjs/toastr.min.css">
  <!-- fullcalendar -->
  <link rel="stylesheet" href="/src/fullcalendar/dist/fullcalendar.min.css">
  <!-- Datetimepicker -->
  <link rel="stylesheet" href="/src/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css"/>
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('src/select2/dist/css/select2.min.css') }}">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('students.index') }}">Students</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('students.index') }}" class="btn btn-xs btn-default"></i> Back</a>
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
  <div class="col-md-5">
    <!-- Student Profile Picture -->
    <div class="box box-default">
      <div class="box-header" style="margin-left: 16px; margin-bottom: -18px;">
        <h3 class="box-title">@yield('button')</h3>
      </div>
      <hr>
      @include('academics.students._profile_pic')
    </div>
    <!-- /.box -->
    @include('academics.students._history_academic')
    @include('academics.students._profile_detail')
  </div>
  <!-- /.col -->
  <div class="col-md-7">
    <div class="box box-default">
      <ul class="nav nav-tabs">
        <li><a data-toggle="tab" aria-expanded="false" style="color: black; font-weight: bold; font-size: 16px; pointer-events: none;">Edit Student</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" style="margin: 15px;">
          <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('students.update', $student->id) }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            @include('academics.students._form_edit')
          </form>
          <br>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>
@include('academics.students._modal_edit_classroom')
@endsection

@section('scripts')
    <!-- Datetimepicker -->
    <script type="text/javascript" src="{{ asset('src/moment/min/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!-- toastr notifications -->
    <script type="text/javascript" src="/src/toastrjs/toastr.min.js"></script>
    <!-- fullcalendar -->
    <script type="text/javascript" src="/src/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="{{ asset('src/select2/dist/js/select2.min.js') }}"></script>
    <!-- icheck checkboxes -->
    <script type="text/javascript" src="/src/iCheck/icheck.min.js"></script>
    @include('shared._part_notification')
    <script>
          // Edit Classroom
          $(document).on('click', '.edit-modal', function() {
              $('.modal-title').text('Edit');
              $('#id_edit').val($(this).data('id'));
              $('#index_edit').val($(this).data('index'));
              id = $('#id_edit').val();
              $('#editModal').modal('show');
          });
          $('.modal-footer').on('click', '.edit', function() {
              $.ajax({
                  type: 'PUT',
                  url: '/home/academics/classroomstudent/update-allocate-student/' + id,
                  data: {
                      '_token': $('input[name=_token]').val(),
                      'id': $("#id_edit").val(),
                      'index': $("#index_edit").val(),
                      'classroomname': $('#classroomname_edit').val(),
                  },
                  success: function(data) {
                      window.location.reload();
                  },
              });
          });
    </script>
    <script>
      /* Datetimepicker*/
      $(function dateTimePicker() {
        $('#datetimepicker1').datetimepicker({
            sideBySide: true
        });
      });
    </script>
    <script>
        $(document).ready(function(){
            $('.statusActive').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '20%'
            });
            $('.statusActive').on("ifClicked", function(event){
                id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::route('students.statusActive') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function(data) {
                        window.location.href = "{{route('students.index')}}";
                    },
                });
            });
            $('.statusActive').on('ifToggled', function(event) {
                $(this).closest('tr').toggleClass('warning');
            });
        });
    </script>
@endsection
