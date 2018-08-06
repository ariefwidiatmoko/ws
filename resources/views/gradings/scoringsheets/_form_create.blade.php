  <input type="hidden" name="created_by" value="{{Auth::user()->name}}">
  <!-- Year Active -->
  <div class="form-group @if ($errors->has('year_id')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
    <label>Year</label>
    <select class="form-control" name="year_id" required>
      <option value="">Select Year</option>
      @foreach ($years as $item)
        <option value="{{ $item->id }}" @if($yearactive->year_id == $item->id) selected="selected" @endif>{{ ucfirst($item->yearname) }}</option>
      @endforeach
    </select>
  </div>
  @if ($errors->has('year_id')) <p class="help-block">{{ $errors->first('year_id') }}</p> @endif

  <!-- Semester Active -->
  <div class="form-group @if ($errors->has('semester_id')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
    <label>Semester</label>
    <select class="form-control" name="semester_id" required>
      <option value="">Select Semester</option>
      @foreach ($semesters as $item)
        <option value="{{ $item->id }}" @if($yearactive->semester_id == $item->id) selected="selected" @endif>{{ ucfirst($item->semestername) }}</option>
      @endforeach
    </select>
  </div>
  @if ($errors->has('semester_id')) <p class="help-block">{{ $errors->first('semester_id') }}</p> @endif

  <!-- Classroom -->
  <div class="form-group @if ($errors->has('classroom_id')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
    <label>Classroom</label>
    <select id="select-classroom" data-placeholder="Select Classroom" class="form-control" style="width:100%" name="classroom_id" required>
      <option value="">Select Classroom</option>
      @foreach ($classrooms as $item)
        <option value="{{ $item->id }}">{{ $item->classroomname }}</option>
      @endforeach
    </select>
  </div>
  @if ($errors->has('classroom_id')) <p class="help-block">{{ $errors->first('classroom_id') }}</p> @endif

  <!-- Subject -->
  <div class="form-group @if ($errors->has('subject_id')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
    <label>Subject</label>
    <select id="select-subject" class="form-control" name="subject_id" required>
      <option value="">Select Subject</option>
      @foreach ($subjects as $item)
        <option value="{{ $item->id }}" @if(old('subject_id') == $item->id) selected @endif>{{ ucfirst($item->subjectname) }}</option>
      @endforeach
    </select>
  </div>
  @if ($errors->has('subject_id')) <p class="help-block">{{ $errors->first('subject_id') }}</p> @endif

  <!-- Column Scoringsheet -->
  <div class="form-group @if ($errors->has('columnscore')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
    <label>Column Score</label>
    <select id="select-subject" class="form-control" name="columnscore" required>
      <option value="">Select Column Score</option>
      <option value="5">5 Columns</option>
      <option value="10">10 Columns</option>
      <option value="15" selected>15 Columns</option>
      <option value="20">20 Columns</option>
      <option value="30">30 Columns</option>
      <option value="40">40 Columns</option>
      <option value="50">50 Columns</option>
    </select>
  </div>
  @if ($errors->has('columnscore')) <p class="help-block">{{ $errors->first('columnscore') }}</p> @endif
