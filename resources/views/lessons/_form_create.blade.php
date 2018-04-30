  <!-- Subject of Lesson -->
  <div class="form-group @if ($errors->has('subject_id')) has-error @endif">
    <label>Select Subject</label>
    <select class="form-control" name="subject_id" required>
      <option value="">Select Subject</option>
      @foreach ($subjects as $item)
        @if(old('subject_id') == $item->id )
          <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
        @else
          <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endif
      @endforeach
    </select>
    @if ($errors->has('subject_id')) <span class="help-block">{{$errors->first('subject_id')}}</span> @endif
  </div>

  <!-- Title of Lesson-->
  <div class="form-group @if ($errors->has('title')) has-error @endif">
    <label>Title</label>
    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
  </div>

  <!-- Content of Lesson -->
  <div class="form-group @if ($errors->has('content')) has-error @endif">
    <label>Content</label>
    <textarea name="content" class="form-control my-editor">{{ old('content') }}</textarea>
    @if ($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
  </div>

    <!-- checkbox live of Lesson -->
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input id="hidePub" onclick="hidePublish()" type="checkbox" name="live" checked>
          Publish
        </label>
      </div>
    </div>
    @if ($errors->has('live'))<span class="help-block">{{$errors->first('live')}}</span> @endif
    {{-- Publish Later
    <!-- Publish Time -->
    <div id="publishTime" class="form-group @if ($errors->has('published_at')) has-error @endif" style="display:none">
      <label>Set Time</label>
      <input value="{{ old('title') }}" name="published_at" type="text" class="form-control" id="datetimepicker12" data-date-format="YYYY-MM-DD HH:mm:ss">
    </div>
    @if ($errors->has('published_at')) <p class="help-block">{{ $errors->first('published_at') }}</p> @endif
    --}}
