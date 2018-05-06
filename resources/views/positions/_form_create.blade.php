  <!-- Name -->
  <div class="form-group @if ($errors->has('positionname')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
    <label>Name</label>
    <input type="text" class="form-control" name="positionname" value="">
  </div>
  @if ($errors->has('positionname')) <p class="help-block">{{ $errors->first('positionname') }}</p> @endif

  <!-- Checkbox Live -->
  <div class="form-group" style="margin-left: 1px; margin-right: 1px;">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="positionactive" checked>
        Live
      </label>
    </div>
  </div>
