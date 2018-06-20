<!-- Name -->
<div class="form-group @if ($errors->has('classroomname')) has-error @endif">
    <label>Name</label>
        <input type="text" class="form-control" name="classroomname" value="" required>
        @if ($errors->has('classroomname')) <p class="help-block">{{ $errors->first('classroomname') }}</p> @endif
</div>
<!-- Alias -->
<div class="form-group @if ($errors->has('alias')) has-error @endif">
    <label>Alias</label>
        <input type="text" class="form-control" name="alias" value="" required>
        @if ($errors->has('alias')) <p class="help-block">{{ $errors->first('alias') }}</p> @endif
</div>
