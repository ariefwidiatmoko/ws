@extends('layouts.dashboard')

@section('title', 'Edit Lesson')

@section('stylesheets')
  <!-- Datetimepicker -->
  <link rel="stylesheet" href="/src/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css" />
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('src/select2/dist/css/select2.min.css') }}">
@endsection

@section('navmenu')
  <a href="{{ route('home') }}">Dashboard</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a href="{{ route('lessons.index') }}">Lessons</a> <i class="fa fa-caret-right fa fw" style="color: #3c8dbc;"></i>
  <a class="active" style="color: grey;">@yield('title')</a>
@endsection

@section('button')
  <a href="{{ route('lessons.index') }}" class="btn btn-xs btn-default">Back</a>
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
    <div class="box-body" style="margin-top: -12px; margin-left: 15px; margin-right: 15px;">
      <form enctype="multipart/form-data" action="{{ route('lessons.update', $lesson->id) }}" method="POST">
          {{ method_field('PUT') }}
          {{ csrf_field() }}
          @include('contents.lessons._form_edit')
            <div class="box-footer">
              <!-- Submit Form Button -->
              {!! Form::submit('Save', ['class' => 'btn btn-xs btn-success']) !!}
              <!-- Back Button -->
              <a href="{{ route('lessons.show', $lesson->id) }}" type="button" class="btn btn-default btn-xs">Cancel</a>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
@endsection

@section('scripts')
  <script src="{{ asset('src/tinymce_4.7.7/js/tinymce/tinymce.min.js') }}"></script>
  <!-- Datetimepicker -->
  <script type="text/javascript" src="{{ asset('src/moment/min/moment.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('src/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') }}"></script>
  <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
  <script>

      var editor_config = {
        path_absolute : "/",
        height: 280,
        selector: "textarea.my-editor",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
          var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
          var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

          var cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;
          if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
          } else {
            cmsURL = cmsURL + "&type=Files";
          }

          tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
          });
        }
      };
      tinymce.init(editor_config);
  </script>
@endsection
