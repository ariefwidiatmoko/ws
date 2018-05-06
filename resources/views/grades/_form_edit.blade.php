<!-- user_id -->
<input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

<!-- Name -->
<div class="form-group @if ($errors->has('gradename')) has-error @endif">
    <label>Name</label>
        <input type="text" class="form-control" name="gradename" value="{{ $grade->gradename }}" required>
        @if ($errors->has('gradename')) <p class="help-block">{{ $errors->first('gradename') }}</p> @endif
</div>

<!-- Alias -->
<div class="form-group @if ($errors->has('alias')) has-error @endif">
    <label>Alias</label>
        <input type="text" class="form-control" name="alias" value="{{ $grade->alias }}" required>
        @if ($errors->has('alias')) <p class="help-block">{{ $errors->first('alias') }}</p> @endif
</div>
