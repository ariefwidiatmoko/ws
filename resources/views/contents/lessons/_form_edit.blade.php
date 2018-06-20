  <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

  <!-- Subject of Lesson-->
  <div class="form-group">
    <label>Select Subject</label>
    <select class="form-control" name="subject_id" required>
      @foreach ($subjects as $key => $item)
        <option value="{{ $item->id }}" {{ $item->id == $lesson->subject_id ? 'selected' : '' }}>{{ $item->subjectname }}</option>
      @endforeach
    </select>
  </div>

  <!-- Title of Lesson -->
  <div class="form-group @if ($errors->has('lessontitle')) has-error @endif">
    <label>Title</label>
    <input type="text" class="form-control" name="lessontitle" value="{{ $lesson->lessontitle }}" required>
    @if ($errors->has('lessontitle')) <p class="help-block">{{ $errors->first('lessontitle') }}</p> @endif
  </div>

  <!-- Content of Lesson -->
  <div class="form-group @if ($errors->has('lessoncontent')) has-error @endif">
    <label>Content</label>
    <textarea class="form-control my-editor" name="lessoncontent" required>{{ $lesson->lessoncontent }}</textarea>
  </div>
  @if ($errors->has('lessoncontent')) <p class="help-block">{{ $errors->first('lessoncontent') }}</p> @endif

  <!-- checkbox live of Lesson -->
  <div class="form-group">
    <div class="checkbox">
      <label>
        <input id="hidePub" onclick="hidePublish()" type="checkbox" name="lessonactive" {{ $lesson->lessonactive == 1 ? 'checked' : ''}}>
        Publish
      </label>
    </div>
  </div>
  {{-- Publish Later
  <!-- Publish Time -->
  <div id="publishTime" class="form-group @if ($errors->has('published_at')) has-error @endif" style="display:none">
    <label>Publish Time</label>
    <input value="{{ $lesson->published_at }}" name="published_at" type="text" class="form-control" id="datetimepicker12" data-date-format="YYYY-MM-DD HH:mm:ss">
  </div>
  @if ($errors->has('published_at')) <p class="help-block">{{ $errors->first('published_at') }}</p> @endif
  --}}
