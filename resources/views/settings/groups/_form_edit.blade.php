<!-- Group Score Name -->
<div class="form-group @if ($errors->has('groupname')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
  <label>Group Score</label>
  <input type="text" class="form-control" name="groupname" value="{{$group->groupname}}" required>
</div>
@if ($errors->has('groupname')) <p class="help-block">{{ $errors->first('groupname') }}</p> @endif

<!-- Group Score Description -->
<div class="form-group @if ($errors->has('groupdescription')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
  <label>Group Score Description</label>
  <input type="text" class="form-control" name="groupdescription" value="{{$group->groupdescription}}">
</div>
@if ($errors->has('groupdescription')) <p class="help-block">{{ $errors->first('groupdescription') }}</p> @endif
