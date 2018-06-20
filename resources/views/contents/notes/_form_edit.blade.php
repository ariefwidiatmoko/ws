<!-- user_id -->
<input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">
<!-- name -->
<div class="form-group @if ($errors->has('notesegement')) has-error @endif">
  <label>Segment</label>
  <select class="form-control" name="notesegement" required>
    @foreach($segment as $select => $item)
      <option value="{{$item}}" {{$note->notesegement == $item ? 'selected' : ''}}>{{$item}}</option>
    @endforeach
  </select>
  @if ($errors->has('notesegement')) <p class="help-block">{{ $errors->first('notesegement') }}</p> @endif
</div>
<!-- title -->
<div class="form-group @if ($errors->has('notetitle')) has-error @endif">
  <label>Title</label>
  <input type="text" class="form-control" name="notetitle" value="{{ $note->notetitle }}">
  @if ($errors->has('notetitle')) <p class="help-block">{{ $errors->first('notetitle') }}</p> @endif
</div>
<!-- Description -->
<div class="form-group @if ($errors->has('content')) has-error @endif">
  <label>Description</label>
  <textarea name="description" class="form-control my-editor">{{ $note->description }}</textarea>
  @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
</div>
<!-- checkbox live -->
<div class="form-group">
  <div class="checkbox">
    <label>
    <input type="checkbox" name="noteactive" {{ $note->noteactive == 1 ? 'checked' : '' }}>
    Live</label>
  </div>
</div>

<!-- Image -->
<div class="form-group">
  <label>Image Thumbnail</label>
  <input type="file" name="note_image" value="">
</div>
