<!-- Name Form Input -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    <label>Username</label>
        <input value="" name="name" type="text" class="form-control" placeholder="Username" required>
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- email Form Input -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    <label>Email</label>
        <input name="email" type="text" class="form-control" placeholder="email" required>
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>

<!-- password Form Input -->
<div class="form-group @if ($errors->has('password')) has-error @endif">
    <label>Password</label>
        <input name="password" type="password" class="form-control" placeholder="password" autocomplete="new-password" required>
    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
</div>

<!-- Roles Form Input -->
<div class="form-group @if ($errors->has('roles')) has-error @endif">
    <label>Roles</label>
        {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null, ['class'=>'form-control']) !!}
    @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
</div>

<!-- Permissions -->
@if(isset($user))
    @include('shared._user_permissions', ['closed' => 'true', 'model' => $user ])
@endif
