<!-- User_id -->
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<!-- Name -->
<div class="form-group @if ($errors->has('subjectname')) has-error @endif">
    <label>Name</label>
        <input type="text" class="form-control" name="subjectname" value="" required>
        @if ($errors->has('subjectname')) <p class="help-block">{{ $errors->first('subjectname') }}</p> @endif
</div>
<!-- Alias -->
<div class="form-group @if ($errors->has('alias')) has-error @endif">
    <label>Alias</label>
        <input type="text" class="form-control" name="alias" value="" required>
        @if ($errors->has('alias')) <p class="help-block">{{ $errors->first('alias') }}</p> @endif
</div>
<!-- checkbox live -->
<div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="subjectactive" checked>
      Live
    </label>
  </div>
</div>
