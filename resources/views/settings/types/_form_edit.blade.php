<!-- Type Score Name -->
<div class="form-group @if ($errors->has('typename')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
  <label>Type Score</label>
  <input type="text" class="form-control" name="typename" value="{{$type->typename}}" required>
</div>
@if ($errors->has('typename')) <p class="help-block">{{ $errors->first('typename') }}</p> @endif

<!-- Type Score Description -->
<div class="form-group @if ($errors->has('typedescription')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
  <label>Type Score Description</label>
  <input type="text" class="form-control" name="typedescription" value="{{$type->typedescription}}">
</div>
@if ($errors->has('typedescription')) <p class="help-block">{{ $errors->first('typedescription') }}</p> @endif
