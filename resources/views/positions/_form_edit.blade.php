<!-- Updated by -->
<input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

<!-- Name -->
<div class="form-group @if ($errors->has('positionname')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
  <label>Name</label>
  <input type="text" class="form-control" name="positionname" value="{{ $position->positionname }}">
</div>
@if ($errors->has('positionname')) <p class="help-block">{{ $errors->first('positionname') }}</p> @endif

<!-- checkbox live Form input -->
<div class="form-group" style="margin-left: 1px; margin-right: 1px;">
    <label>
      <input type="checkbox" name="positionactive" {{ $position->positionactive == 1 ? 'checked' : ''}}>
      Live
    </label>
</div>
