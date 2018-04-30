<!-- Username -->
<div class="control-group @if ($errors->has('name')) has-error @endif">
    <label class="control-label">Username</label>
    <div class="controls">
        <input value="{{ $profile->user->name }}" name="name" type="text" class="form-control" placeholder="Username">
    </div>
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>
<!-- Email -->
<div class="control-group @if ($errors->has('email')) has-error @endif">
    <label class="control-label">Email</label>
    <div class="controls">
        <input value="{{ $profile->user->email }}" name="email" type="text" class="form-control" placeholder="Email">
    </div>
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>
<!-- Fullame -->
<div class="control-group @if ($errors->has('fullname')) has-error @endif">
    <label class="control-label">Fullname</label>
    <div class="controls">
        <input value="{{ $profile->fullname }}" name="fullname" type="text" class="form-control" placeholder="Fullname">
    </div>
    @if ($errors->has('fullname')) <p class="help-block">{{ $errors->first('fullname') }}</p> @endif
</div>
<!-- Date of Birth -->
<div class="control-group @if ($errors->has('dob')) has-error @endif">
    <label class="control-label">Date of Birth (mm-dd-yy)</label>
    <div class="controls">
        <input data-date-format="dd-mm-yyyy" value="{{ $profile->dob ? $profile->dob->format('Y-m-d') : null }}" name="dob" type="date" class="datepicker form-control" placeholder="Date of Birth">
    </div>
    @if ($errors->has('dob')) <p class="help-block">{{ $errors->first('dob') }}</p> @endif
</div>
<!-- Position -->
<div class="control-group @if ($errors->has('position')) has-error @endif">
    <label class="control-label">Position</label>
    <div class="controls">
        <input value="{{ $profile->position }}" name="position" type="text" class="form-control" placeholder="Position">
    </div>
    @if ($errors->has('position')) <p class="help-block">{{ $errors->first('position') }}</p> @endif
</div>
<!-- Address -->
<div class="control-group @if ($errors->has('address')) has-error @endif">
    <label class="control-label">Address</label>
    <div class="controls">
        <input value="{{ $profile->address }}" name="address" type="text" class="form-control" placeholder="Address">
    </div>
    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
</div>
<!-- About -->
<div class="control-group @if ($errors->has('about')) has-error @endif">
    <label class="control-label">About</label>
    <div class="controls">
        <textarea name="About" class="form-control">{{ $profile->about }}</textarea>
    </div>
    @if ($errors->has('about')) <p class="help-block">{{ $errors->first('about') }}</p> @endif
</div>
<!-- avatar -->
<div class="control-group">
    <label class="control-label">Avatar ( size 1:1 )</label>
    <div class="controls">
        <input type="file" name="profile_avatar" value="">
    </div>
</div>
<!-- Reset Password -->
<div class="control-group">
    <label class="control-label">Reset Password</label>
    <div class="controls">
        <input value="" name="password" type="password" class="form-control" placeholder="Password" autocomplete="new-password">
    </div>
</div>
