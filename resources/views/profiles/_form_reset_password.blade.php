<!-- Change Password Form Input -->
<div class="control-group @if ($errors->has('password')) has-error @endif">
    <label class="control-label">Change Password</label>
    <div class="controls">
        <input id="password" name="password" type="password" class="span12" placeholder="Change Password">
    </div>
    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
</div>

<!-- Confirm Form Input -->
<div class="control-group @if ($errors->has('guard_name')) has-error @endif">
    <label for="password-confirm" class="control-label">Confirm</label>
    <div class="controls">
        <input id="password-confirm" name="password-confirm" type="password" class="span12" placeholder="Confirm">
    </div>
</div>
