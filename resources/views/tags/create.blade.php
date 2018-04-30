@extends('layouts.dashboard')

@section('title', 'New Role')

@section('stylesheets')

@endsection

@section('navmenu')
  <li><a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i> Dashboard</a></li>
  <li class="active"><a href="{{ route('roles.index') }}">Roles</a></li>
  <li class="active">@yield('title')</li>
@endsection

@section('button')
  <a href="{{ route('roles.index') }}" class="btn btn-xs btn-default"><i class="fa fa-reply fa-fw"></i> Back</a>
@endsection

@section('content')
  <section class="content" id="main-content" style="margin-top: -30px; margin-left: -1px;">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">@yield('title')</h3>
            <div class="pull-right">
              @yield('button')
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form enctype="multipart/form-data" role="form" action="{{ route('roles.store') }}" method="POST">
              {{ csrf_field() }}
              <!-- Tags -->
              <div class="form-group @if ($errors->has('tags')) has-error @endif">
                <div class="row">
                  <div class="col-md-12">
                    <label for="txtTags">Tags</label>
                    <input type="text" class="form-control" id="txtTags" name="tags" data-role="tagsinput">
                  </div>
                </div>
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
    </div>
  </section>
@endsection

@section('scripts')<!-- Bootstrap tags input -->
  <script src="{{asset('/src/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
  <!-- Type aheaed -->
  <script src="{{ asset('/src/typeahead.js/dist/typeahead.bundle.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/src/typeahead.js/dist/bloodhound.min.js') }}" type="text/javascript"></script>
  <script type="text/javascript">
      // Get the reference to the input field
      var elt = $('#txtTags');

      var skills = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                  url: '{!!url("/")!!}' + '/api/find?keyword=%QUERY%',
                  wildcard: '%QUERY%',
            }
      });
      tags.initialize();

      $('#txtTags').tagsinput({
      itemValue : 'id',
      itemText  : 'name',
      maxChars: 10,
      trimValue: true,
      allowDuplicates : false,
      freeInput: false,
      focusClass: 'form-control',
      tagClass: function(item) {
          if(item.display)
             return 'label label-' + item.display;
          else
              return 'label label-default';

      },
      onTagExists: function(item, $tag) {
          $tag.hide().fadeIn();
      },
      typeaheadjs: [{
                hint: false,
                        highlight: true
                    },
                    {
                       name: 'tags',
                    itemValue: 'id',
                    displayKey: 'name',
                    source: tags.ttAdapter(),
                    templates: {
                        empty: [
                            '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                        ],
                        header: [
                            '<ul class="list-group">'
                        ],
                        suggestion: function (data) {
                            return '<li class="list-group-item">' + data.name + '</li>'
                        }
                    }
        }]
      });
  </script>
@endsection
