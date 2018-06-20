<!-- name -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
  <label>Segment</label>
  <select class="form-control" name="name" required>
    <option value="">Select Segment</option>
    <option value="0">Announcement</option>
    <option value="1">News</option>
    <option value="2">Event</option>
    <option value="3">Final Exam</option>
    <option value="4">Holiday</option>
  </select>
  @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- title -->
<div class="form-group @if ($errors->has('title')) has-error @endif">
  <label>Title</label>
  <input type="text" class="form-control" name="title" value="">
  @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
</div>

<!-- Description -->
<div class="form-group @if ($errors->has('description')) has-error @endif">
  <label>Description</label>
  <textarea name="description" class="form-control my-editor">{{ old('description') }}</textarea>
  @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
</div>

<!-- checkbox live of Note -->
<div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="live" checked>
      Live
    </label>
  </div>
</div>

<!-- Image of Note -->
<div class="control-group">
  <label>Image Thumbnail</label>
  <input type="file" class="form-control" name="note_image" value="">
</div>
