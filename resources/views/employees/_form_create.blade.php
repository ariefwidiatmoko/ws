<!-- User_id -->
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<!-- Fullname -->
<div class="form-group @if ($errors->has('employeename')) has-error @endif">
  <label>Fullname</label>
  <input type="text" class="form-control" name="employeename" value="">
  @if ($errors->has('employeename')) <p class="help-block">{{ $errors->first('employeename') }}</p> @endif
</div>
<!-- Date of Birth -->
<div class="form-group @if ($errors->has('dob')) has-error @endif">
  <label>Date of Birth</label>
  <input value="{{ $nowDate }}" name="dob" type="text" class="form-control" id="datetimepicker1" data-date-format="YYYY-MM-DD">
  @if ($errors->has('dob')) <p class="help-block">{{ $errors->first('dob') }}</p> @endif
</div>
<!-- phone -->
<div class="form-group @if ($errors->has('phone')) has-error @endif">
    <label>Phone</label>
        <input name="phone" type="text" class="form-control" placeholder="phone">
    @if ($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
</div>
<!-- email -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    <label>Email</label>
        <input name="email" type="text" class="form-control" placeholder="email">
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>
<!-- address -->
<div class="form-group @if ($errors->has('address')) has-error @endif">
    <label>Address</label>
    <input name="address" type="text" class="form-control" placeholder="address">
    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
</div>
<!-- education -->
<div class="form-group @if ($errors->has('education')) has-error @endif">
    <label>Education</label>
    <input name="education" type="text" class="form-control" placeholder="education">
    @if ($errors->has('education')) <p class="help-block">{{ $errors->first('education') }}</p> @endif
</div>
<!-- statusActive -->
<div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="employeeactive" checked>
      Active
    </label>
  </div>
</div>
<!-- Position -->
<div class="form-group">
  <label>Position</label>
  <select class="form-control select2" name="positions[]" multiple="multiple">
    @foreach ($positions as $item)
      <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
  </select>
</div>
<!-- quote -->
<div class="form-group @if ($errors->has('quote')) has-error @endif">
    <label>Quote</label>
    <textarea name="quote" class="form-control" placeholder="Quote"></textarea>
    @if ($errors->has('quote')) <p class="help-block">{{ $errors->first('quote') }}</p> @endif
</div>
<!-- about -->
<div class="form-group @if ($errors->has('about')) has-error @endif">
    <label>About</label>
    <textarea name="about" class="form-control" placeholder="About"></textarea>
    @if ($errors->has('about')) <p class="help-block">{{ $errors->first('about') }}</p> @endif
</div>
<!-- avatar -->
<div class="form-group">
  <label>Profile Picture</label>
  <input type="file" class="form-control" name="employee_img" value="">
</div>
