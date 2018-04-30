<!-- user_id -->
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

  <!-- Name -->
  <div class="form-group @if ($errors->has('name')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="">
  </div>
  @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif

  <!-- Checkbox Live -->
  <div class="form-group" style="margin-left: 1px; margin-right: 1px;">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="live" checked>
        Live
      </label>
    </div>
  </div>
