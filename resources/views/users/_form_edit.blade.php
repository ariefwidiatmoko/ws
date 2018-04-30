<input type="hidden" name="user_id" value="{{ $user->id }}">
<!-- Name Form Input -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    <label>Username</label>
        <input value="{{ $user->name }}" name="name" type="text" class="form-control" placeholder="Username">
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- email Form Input -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    <label>Email</label>
        <input value="{{ $user->email }}" name="email" type="text" class="form-control" placeholder="email">
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>

<!-- Roles Form Input -->
<div class="form-group @if ($errors->has('roles')) has-error @endif">
    <label>Roles</label>
        {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null, ['class'=>'form-control']) !!}
    @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
</div>
