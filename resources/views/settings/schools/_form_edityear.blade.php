<!-- User -->
<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
<!-- Updated by-->
<input type="hidden" name="updated_by" value="{{Auth::user()->name}}">
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
