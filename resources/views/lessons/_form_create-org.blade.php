
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
  </div>  <!-- Subject of Lesson -->
    <div class="form-group @if ($errors->has('subject_id')) has-error @endif">
      <label>Select Subject</label>
      <select class="form-control" name="subject_id" required>
        <option value="">Select Subject</option>
        @foreach ($subjects as $item)
          <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
      </select>
      @if ($errors->has('subject_id')) <span class="help-block">{{$errors->first('subject_id')}}</span> @endif
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

    <!-- Publish Time -->
    <div id="publishTime" class="form-group @if ($errors->has('published_at')) has-error @endif" style="display:none">
      <label>Set Time</label>
      <input value="{{ old('title') }}" name="published_at" type="text" class="form-control" id="datetimepicker12" data-date-format="YYYY-MM-DD HH:mm:ss">
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
            <input type="text" class="form-control" id="thumbnail" name="attach_file" value="" placeholder="Link: /Attachment/File/...">
          </div>
        </div>
        <div class="col-xs-6">
          <div class="input-group input-group-sm col-xs-12">
            <input type="text" class="form-control" name="file_desc" value="" placeholder="File description">
            <span class="input-group-btn">
              <button id="addFA" type="button" class="btn btn-default btn-flat"><i class="fa fa-plus fa-fw"></i> Add Attachment</button>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
