<!-- Fullame -->
<div class="control-group @if ($errors->has('fullname')) has-error @endif">
    <label class="control-label">Fullname</label>
    <div class="controls">
        <input value="{{ $student->studentname }}" name="studentname" type="text" class="form-control" placeholder="Fullname">
    </div>
    @if ($errors->has('studentname')) <p class="help-block">{{ $errors->first('studentname') }}</p> @endif
</div>
<!-- Date of Birth -->
<div class="control-group @if ($errors->has('dob')) has-error @endif">
    <label class="control-label">Date of Birth (mm-dd-yy)</label>
    <div class="controls">
        <input data-date-format="dd-mm-yyyy" value="{{ $employee->dob ? $employee->dob->format('Y-m-d') : null }}" name="dob" type="date" class="datepicker form-control" placeholder="Date of Birth">
    </div>
    @if ($errors->has('dob')) <p class="help-block">{{ $errors->first('dob') }}</p> @endif
</div>
<!-- Phone -->
<div class="control-group @if ($errors->has('phone')) has-error @endif">
    <label class="control-label">Phone</label>
    <div class="controls">
        <input value="{{ $employee->phone }}" name="phone" type="text" class="form-control" placeholder="Fullname">
    </div>
    @if ($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
</div>
<!-- Email -->
<div class="control-group @if ($errors->has('email')) has-error @endif">
    <label class="control-label">Email</label>
    <div class="controls">
        <input value="{{ $employee->user->email }}" name="email" type="text" class="form-control" placeholder="Email">
    </div>
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>
<!-- Address -->
<div class="control-group @if ($errors->has('address')) has-error @endif">
    <label class="control-label">Address</label>
    <div class="controls">
        <input value="{{ $employee->address }}" name="address" type="text" class="form-control" placeholder="Address">
    </div>
    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
</div>
<!-- Education -->
<div class="control-group @if ($errors->has('education')) has-error @endif">
    <label class="control-label">Education</label>
    <div class="controls">
        <input value="{{ $employee->education }}" name="education" type="text" class="form-control" placeholder="Address">
    </div>
    @if ($errors->has('education')) <p class="help-block">{{ $errors->first('education') }}</p> @endif
</div>
<!-- statusActive -->
<div class="control-group">
  <div class="checkbox">
    <label class="control-label">
      <input type="checkbox" name="statusActive" checked>
      Active
    </label>
  </div>
</div>
<!-- Position -->
<div class="control-group">
  <label class="control-label">Position</label>
  <select class="form-control select2" name="positions[]" multiple="multiple">
    @foreach ($positions as $item)
      <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
  </select>
</div>
<!-- Quote -->
<div class="control-group @if ($errors->has('quote')) has-error @endif">
    <label class="control-label">Quote</label>
    <div class="controls">
        <textarea name="quote" class="form-control">{{ $employee->quote }}</textarea>
    </div>
    @if ($errors->has('quote')) <p class="help-block">{{ $errors->first('quote') }}</p> @endif
</div>
<!-- About -->
<div class="control-group @if ($errors->has('about')) has-error @endif">
    <label class="control-label">About</label>
    <div class="controls">
        <textarea name="about" class="form-control">{{ $employee->about }}</textarea>
    </div>
    @if ($errors->has('about')) <p class="help-block">{{ $errors->first('about') }}</p> @endif
</div>
<!-- avatar -->
<div class="control-group">
    <label class="control-label">Profile Picture</label>
    <div class="controls">
        <input type="file" name="employee_img" value="">
    </div>
</div>
<!-- Reset Password -->
<div class="control-group">
    <label class="control-label">Reset Password</label>
    <div class="controls">
        <input value="" name="password" type="password" class="form-control" placeholder="Password" autocomplete="new-password">
    </div>
</div>
