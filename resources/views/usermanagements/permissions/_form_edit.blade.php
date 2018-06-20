<!-- Fullame Form Input -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    <label>Name</label>
        <input value="{{ $permission->name }}" name="name" type="text" class="form-control" placeholder="Example: view_users, add_users, edit_users, delete_users">
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- Web Form Input -->
<div class="form-group @if ($errors->has('guard_name')) has-error @endif">
    <label>Guard Name</label>
        <input value="{{ $permission->guard_name }}" name="guard_name" type="text" class="form-control" disabled>
    @if ($errors->has('guard_name')) <p class="help-block">{{ $errors->first('guard_name') }}</p> @endif
</div>
