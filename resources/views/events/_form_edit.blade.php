<!-- user_id -->
<input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

<!-- Name -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    <label>Name</label>
        <input type="text" class="form-control" name="name" value="{{ $category->name }}">
        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- Alias -->
<div class="form-group @if ($errors->has('alias')) has-error @endif">
    <label>Alias</label>
        <input type="text" class="form-control" name="alias" value="{{ $category->alias }}">
        @if ($errors->has('alias')) <p class="help-block">{{ $errors->first('alias') }}</p> @endif
</div>

<!-- checkbox live -->
<div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="live" {{ $category->live == 1 ? 'checked' : ''}}>
      Live
    </label>
  </div>
</div>
