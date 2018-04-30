  <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

  <!-- Title of Lesson -->
  <div class="form-group @if ($errors->has('title')) has-error @endif">
    <label>Title</label>
    <input type="text" class="form-control" name="title" value="{{ $lesson->title }}" required>
    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
  </div>

  <!-- Content of Lesson -->
  <div class="form-group @if ($errors->has('content')) has-error @endif">
    <label>Content</label>
    <textarea class="form-control my-editor" name="content" required>{{ $lesson->content }}</textarea>
  </div>
  @if ($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
  <!-- Subject of Lesson-->
  <div class="form-group">
    <label>Select Subject</label>
    <select class="form-control" name="category_id" required>
      @foreach ($subjects as $key => $item)
        <option value="{{ $item->id }}" {{ $item->id == $lesson->subject_id ? 'selected' : '' }}>{{ $item->name }}</option>
      @endforeach
    </select>
  </div>

  <!-- checkbox live of Lesson -->
  <div class="form-group">
    <div class="checkbox">
      <label>
        <input id="hidePub" onclick="hidePublish()" type="checkbox" name="live" {{ $lesson->live == 1 ? 'checked' : ''}}>
        Publish
      </label>
    </div>
  </div>

  <!-- Publish Time -->
  <div id="publishTime" class="form-group @if ($errors->has('published_at')) has-error @endif" style="display:none">
    <label>Publish Time</label>
    <input value="{{ $lesson->published_at }}" name="published_at" type="text" class="form-control" id="datetimepicker12" data-date-format="YYYY-MM-DD HH:mm:ss">
  </div>
  @if ($errors->has('published_at')) <p class="help-block">{{ $errors->first('published_at') }}</p> @endif

  <!-- File Attachment -->
  <div id="fileAttach" class="form-group">
    <div class="row">
      <div class="col-xs-12">
        <label>File Attachment</label>
      </div>
      <div class="col-xs-6">
        <div class="input-group input-group-sm col-xs-12">
          <span class="input-group-btn">
            <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-default btn-flat"><i class="fa fa-paperclip fa-fw"></i> Choose</button>
          </span>
          <input type="text" class="form-control" id="thumbnail" name="attach_file" value="{{ $lesson->attach_file }}" placeholder="Link: /Attachment/File/...">
        </div>
      </div>
      <div class="col-xs-6">
        <div class="input-group input-group-sm col-xs-12">
          <input type="text" class="form-control" name="file_desc" value="{{ $lesson->file_desc }}" placeholder="File description">
          <span class="input-group-btn">
            <button id="addFA" type="button" class="btn btn-default btn-flat"><i class="fa fa-plus fa-fw"></i> Add Attachment</button>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
