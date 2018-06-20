  <!-- User ID -->
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
  <!-- No ID -->
<div class="form-group @if ($errors->has('noId')) has-error @endif">
  <label>No ID</label>
  <input type="text" class="form-control" name="noId" value="{{ old('noId') }}">
  @if ($errors->has('noId')) <p class="help-block">{{ $errors->first('noId') }}</p> @endif
</div>
<!-- No ID National -->
<div class="form-group @if ($errors->has('noIdNational')) has-error @endif">
  <label>No ID National</label>
  <input type="text" class="form-control" name="noIdNational" value="{{ old('noIdNational') }}">
  @if ($errors->has('noIdNational')) <p class="help-block">{{ $errors->first('noIdNational') }}</p> @endif
</div>
<!-- Fullname -->
<div class="form-group @if ($errors->has('studentname')) has-error @endif">
  <label>Fullname</label>
  <input type="text" class="form-control" name="studentname" value="{{ old('studentname') }}">
  @if ($errors->has('studentname')) <p class="help-block">{{ $errors->first('studentname') }}</p> @endif
</div>
<!-- Nick Name -->
<div class="form-group">
  <label>Nick Name</label>
  <input type="text" class="form-control" name="studentnick" value="{{ old('studentnick') }}">
</div>
<!-- statusActive -->
<div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="studentactive" checked>
      Active
    </label>
  </div>
</div>
