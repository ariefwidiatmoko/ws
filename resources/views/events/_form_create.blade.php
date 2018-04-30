<!-- User_id -->
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<!-- Name -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    <label>Name</label>
        <input type="text" class="form-control" name="name" value="">
        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>
<!-- Alias -->
<div class="form-group @if ($errors->has('alias')) has-error @endif">
    <label>Alias</label>
        <input type="text" class="form-control" name="alias" value="">
        @if ($errors->has('alias')) <p class="help-block">{{ $errors->first('alias') }}</p> @endif
</div>
<!-- checkbox live -->
<div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="live" checked>
      Live
    </label>
  </div>
</div>
