<!-- User_id -->
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<!-- Name -->
<div class="form-group @if ($errors->has('semestername')) has-error @endif">
    <label>Name</label>
        <input type="text" class="form-control" name="semestername" value="" required>
        @if ($errors->has('semestername')) <p class="help-block">{{ $errors->first('semestername') }}</p> @endif
</div>
<!-- Alias -->
<div class="form-group @if ($errors->has('alias')) has-error @endif">
    <label>Alias</label>
        <input type="text" class="form-control" name="alias" value="" required>
        @if ($errors->has('alias')) <p class="help-block">{{ $errors->first('alias') }}</p> @endif
</div>
