<!-- user_id -->
<input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

<!-- Name -->
<div class="form-group @if ($errors->has('subjectname')) has-error @endif">
    <label>Name</label>
        <input type="text" class="form-control" name="subjectname" value="{{ $subject->subjectname }}" required>
        @if ($errors->has('subjectname')) <p class="help-block">{{ $errors->first('subjectname') }}</p> @endif
</div>

<!-- Alias -->
<div class="form-group @if ($errors->has('alias')) has-error @endif">
    <label>Alias</label>
        <input type="text" class="form-control" name="alias" value="{{ $subject->alias }}" required>
        @if ($errors->has('alias')) <p class="help-block">{{ $errors->first('alias') }}</p> @endif
</div>

<!-- checkbox subjectactive -->
<div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="subjectactive" {{ $subject->subjectactive == 1 ? 'checked' : ''}}>
      Live
    </label>
  </div>
</div>
