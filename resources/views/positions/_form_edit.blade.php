<!-- Updated by -->
<input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

<!-- Name -->
<div class="form-group @if ($errors->has('name')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
  <label>Name</label>
  <input type="text" class="form-control" name="name" value="{{ $position->name }}">
</div>
@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif

<!-- checkbox live Form input -->
<div class="form-group" style="margin-left: 1px; margin-right: 1px;">
    <label>
      <input type="checkbox" name="live" {{ $position->live == 1 ? 'checked' : ''}}>
      Live
    </label>
</div>
