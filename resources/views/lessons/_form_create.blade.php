  <!-- Subject of Lesson -->
  <div class="form-group @if ($errors->has('subject_id')) has-error @endif">
    <label>Select Subject</label>
    <select class="form-control" name="subject_id" required>
      <option value="">Select Subject</option>
      @foreach ($subjects as $item)
        @if(old('subject_id') == $item->id )
          <option value="{{ $item->id }}" selected="selected">{{ $item->subjectname }}</option>
        @else
          <option value="{{ $item->id }}">{{ $item->subjectname }}</option>
        @endif
      @endforeach
    </select>
    @if ($errors->has('subject_id')) <span class="help-block">{{$errors->first('subject_id')}}</span> @endif
  </div>

  <!-- Title of Lesson-->
  <div class="form-group @if ($errors->has('lessontitle')) has-error @endif">
    <label>Title</label>
    <input type="text" class="form-control" name="lessontitle" value="{{ old('lessontitle') }}" required>
    @if ($errors->has('lessontitle')) <p class="help-block">{{ $errors->first('lessontitle') }}</p> @endif
  </div>

  <!-- Content of Lesson -->
  <div class="form-group @if ($errors->has('lessoncontent')) has-error @endif">
    <label>Content</label>
    <textarea name="lessoncontent" class="form-control my-editor">{{ old('lessoncontent') }}</textarea>
    @if ($errors->has('lessoncontent')) <p class="help-block">{{ $errors->first('lessoncontent') }}</p> @endif
  </div>

    <!-- checkbox live of Lesson -->
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input id="hidePub" onclick="hidePublish()" type="checkbox" name="lessonactive" checked>
          Publish
        </label>
      </div>
    </div>
    @if ($errors->has('lessonactive'))<span class="help-block">{{$errors->first('lessonactive')}}</span> @endif
    {{-- Publish Later
    <!-- Publish Time -->
    <div id="publishTime" class="form-group @if ($errors->has('published_at')) has-error @endif" style="display:none">
      <label>Set Time</label>
      <input value="{{ old('title') }}" name="published_at" type="text" class="form-control" id="datetimepicker12" data-date-format="YYYY-MM-DD HH:mm:ss">
    </div>
    @if ($errors->has('published_at')) <p class="help-block">{{ $errors->first('published_at') }}</p> @endif
    --}}
