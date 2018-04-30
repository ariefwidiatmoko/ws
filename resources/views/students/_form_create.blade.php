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
<div class="form-group @if ($errors->has('fullname')) has-error @endif">
  <label>Fullname</label>
  <input type="text" class="form-control" name="fullname" value="{{ old('fullname') }}">
  @if ($errors->has('fullname')) <p class="help-block">{{ $errors->first('fullname') }}</p> @endif
</div>
<!-- Nick Name -->
<div class="form-group @if ($errors->has('nickName')) has-error @endif">
  <label>Nick Name</label>
  <input type="text" class="form-control" name="nickName" value="{{ old('nickName') }}">
  @if ($errors->has('nickName')) <p class="help-block">{{ $errors->first('nickName') }}</p> @endif
</div>
<!-- statusActive -->
<div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="statusActive" checked>
      Active
    </label>
  </div>
</div>
