<!-- user_id -->
<input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

<!-- Name -->
<div class="form-group @if ($errors->has('yearname')) has-error @endif">
    <label>Name</label>
        <input type="text" class="form-control" name="yearname" value="{{ $year->yearname }}" required>
        @if ($errors->has('yearname')) <p class="help-block">{{ $errors->first('yearname') }}</p> @endif
</div>

<!-- Alias -->
<div class="form-group @if ($errors->has('alias')) has-error @endif">
    <label>Alias</label>
        <input type="text" class="form-control" name="alias" value="{{ $year->alias }}" required>
        @if ($errors->has('alias')) <p class="help-block">{{ $errors->first('alias') }}</p> @endif
</div>
