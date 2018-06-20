<label><span class="badge bg-aqua">School Profile</span></label>
<hr style="margin: 5px 0px 8px 0px;">
<!-- User -->
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
<!-- Updated by-->
<input type="hidden" name="updated_by" value="{{Auth::user()->name}}">
<!-- School Name -->
<div class="form-group @if ($errors->has('schoolname')) has-error @endif">
  <label>School Name</label>
  <input type="text" class="form-control form-rounded" name="schoolname" value="{{ $school->schoolname }}">
  @if ($errors->has('schoolname')) <p class="help-block">{{ $errors->first('schoolname') }}</p> @endif
</div>
<!-- Principal -->
<div class="form-group @if ($errors->has('principal')) has-error @endif">
  <label>Principal</label>
  <select class="single-selection form-control input-sm" name="principal">
      <option value="">Select</option>
      @foreach ($employees as $item)
        @if ($school->principal == $item->employeename))
         <option value="{{ $item->employeename }}" selected>{{ ucfirst($item->employeename) }}</option>
        @else
         <option value="{{ $item->employeename }}">{{ ucfirst($item->employeename) }}</option>
        @endif
      @endforeach
    </select>
  @if ($errors->has('principal')) <p class="help-block">{{ $errors->first('principal') }}</p> @endif
</div>
<!-- Vice Principal -->
<div class="form-group @if ($errors->has('viceprincipal')) has-error @endif">
  <label>Vice Principal</label>
  <select class="single-selection form-control input-sm" name="viceprincipal">
      <option value="">Select</option>
      @foreach ($employees as $item)
        @if ($school->viceprincipal == $item->employeename))
         <option value="{{ $item->employeename }}" selected>{{ ucfirst($item->employeename) }}</option>
        @else
         <option value="{{ $item->employeename }}">{{ ucfirst($item->employeename) }}</option>
        @endif
      @endforeach
    </select>
  @if ($errors->has('viceprincipal')) <p class="help-block">{{ $errors->first('viceprincipal') }}</p> @endif
</div>
<!-- Address -->
<div class="form-group @if ($errors->has('address')) has-error @endif">
  <label>Address</label>
  <input type="text" class="form-control form-rounded" name="address" value="{{ $school->address }}">
  @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
</div>
<!-- Phone -->
<div class="form-group @if ($errors->has('phone')) has-error @endif">
  <label>Phone</label>
  <input type="text" class="form-control form-rounded" name="phone" value="{{ $school->phone }}">
  @if ($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
</div>
<!-- Email -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
  <label>Email</label>
  <input type="text" class="form-control form-rounded" name="email" value="{{ $school->email }}">
  @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>
<hr>
<label><span class="badge bg-aqua">Setting Academics</span></label>
<hr style="margin: 5px 0px 8px 0px;">
<!-- Year Active -->
<div class="form-group @if ($errors->has('year_id')) has-error @endif">
  <label>Year Active</label>
  <select class="single-selection form-control input-sm" name="year_id">
      <option value="">Select</option>
      @foreach ($years as $item)
        @if ($yearactive->year_id == $item->id))
         <option value="{{ $item->id }}" selected>{{ ucfirst($item->yearname) }}</option>
        @else
         <option value="{{ $item->id }}">{{ ucfirst($item->yearname) }}</option>
        @endif
      @endforeach
    </select>
  @if ($errors->has('year_id')) <p class="help-block">{{ $errors->first('year_id') }}</p> @endif
</div>
<!-- Semester Active -->
<div class="form-group @if ($errors->has('semester_id')) has-error @endif">
  <label>Semester Active</label>
  <select class="single-selection form-control input-sm" name="semester_id">
      <option value="">Select</option>
      @foreach ($semesters as $item)
        @if ($yearactive->semester_id == $item->id))
         <option value="{{ $item->id }}" selected>{{ ucfirst($item->semestername) }}</option>
        @else
         <option value="{{ $item->id }}">{{ ucfirst($item->semestername) }}</option>
        @endif
      @endforeach
    </select>
  @if ($errors->has('semester_id')) <p class="help-block">{{ $errors->first('semester_id') }}</p> @endif
</div>
<!-- Print Date -->
<div class="form-group @if ($errors->has('printdate')) has-error @endif">
  <label>Print Date</label>
  <input value="{{ $school->printdate }}" name="printdate" type="text" class="form-control form-rounded" id="datetimepicker1" data-date-format="YYYY-MM-DD" required>
</div>
