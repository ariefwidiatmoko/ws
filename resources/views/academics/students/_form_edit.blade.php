<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
<div class="form-group @if ($errors->has('noId')) has-error @endif">
  <label class="col-sm-3 control-label">
    No ID / No ID National
  </label>
  <div class="col-sm-4">
    <input value="{{ $student->noId }}" type="text" placeholder="No ID" class="form-control" name="noId">
    @if ($errors->has('noId')) <p class="help-block">{{ $errors->first('noId') }}</p> @endif
  </div>
  <div class="col-sm-5">
    <input value="{{ $student->noIdNational }}" type="text" placeholder="No ID National" class="form-control" name="noIdNational">
  </div>
</div>
<div class="form-group @if ($errors->has('student_img')) has-error @endif">
  <label class="col-sm-3 control-label">
    Profile Picture <small>(Max: 1Mb)</small>
  </label>
  <div class="col-sm-9">
    <input type="file" name="student_img" value="" class="form-control" placeholder="Profile Picture">
    @if ($errors->has('student_img')) <p class="help-block">{{ $errors->first('student_img') }}</p> @endif
  </div>
</div>
<div class="form-group @if ($errors->has('studentname')) has-error @endif">
  <label class="col-sm-3 control-label">
    Fullname
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentname }}" type="text" placeholder="Fullname" class="form-control" name="studentname">
    @if ($errors->has('studentname')) <p class="help-block">{{ $errors->first('studentname') }}</p> @endif
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Nick Name
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentnick }}" type="text" placeholder="Nick Name" class="form-control" name="studentnick">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Phone
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->phone }}" type="text" placeholder="Phone" class="form-control" name="phone">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Email
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->email }}" type="text" placeholder="Email" class="form-control" name="email">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Place & Date of Birth
  </label>
  <div class="col-sm-4">
    <input value="{{ $student->studentprofile->pob }}" type="text" class="form-control" placeholder="Place of Birth" name="pob">
  </div>
  <div class="col-sm-5">
    <input value="{{ $student->studentprofile->dob != null ? $student->studentprofile->dob->format('Y-m-d') : '' }}" name="dob" type="text" class="form-control" id="datetimepicker1" data-date-format="YYYY-MM-DD">
  </div>
</div>
<!-- Gender -->
<div class="form-group">
  <label class="col-sm-3 control-label">Gender</label>
  @if($student->studentprofile->gender == 1)
  <div class="radio col-sm-9">
    <label>
      <input name="gender" id="optionsRadios1" value="1" type="radio" checked>
      Male
    </label>
  </div>
  <label class="col-sm-3 control-label"></label>
  <div class="radio col-sm-9">
    <label>
      <input name="gender" id="optionsRadios2" value="0" type="radio">
      Female
    </label>
  </div>
@else
  <div class="radio col-sm-9">
    <label>
      <input name="gender" id="optionsRadios1" value="1" type="radio">
      Male
    </label>
  </div>
  <label class="col-sm-3 control-label"></label>
  <div class="radio col-sm-9">
    <label>
      <input name="gender" id="optionsRadios2" value="0" type="radio">
      Female
    </label>
  </div>
@endif
</div>
@if ($errors->has('gender'))<span class="help-block">{{$errors->first('gender')}}</span> @endif
<div class="form-group">
  <label class="col-sm-3 control-label">
    Citizenship
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->citizenship }}" type="text" placeholder="Citizenship" class="form-control" name="citizenship">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Family Status
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->familystatus }}" type="text" placeholder="Family Status" class="form-control" name="familystatus">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Siblings / Child Number
  </label>
  <div class="col-sm-4">
    <input value="{{ $student->studentprofile->siblings }}" type="text" placeholder="Siblings" class="form-control" name="siblings">
  </div>
  <div class="col-sm-5">
    <input value="{{ $student->studentprofile->childno }}" type="text" placeholder="Child Number" class="form-control" name="childno">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Family Note
  </label>
  <div class="col-sm-9">
    <textarea name="familiynote" type="text" class="form-control" placeholder="Family Note">{{$student->studentprofile->familiynote}}</textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Health Note
  </label>
  <div class="col-sm-9">
    <textarea name="healthnote" type="text" class="form-control" placeholder="Health Note">{{$student->studentprofile->healthnote}}</textarea>
  </div>
</div>
<hr>
<div class="box-header" style="margin: -20px 0px -20px 0px;">
  <h3 class="box-title"><span class="label label-default">School Related Info</span></h3>
</div>
<hr>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Previus School
  </label>
  <div class="col-sm-9">
    <input name="prevschool" value="{{$student->studentprofile->prevschool}}" type="text" class="form-control" placeholder="Previous School">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Achievement
  </label>
  <div class="col-sm-9">
    <textarea name="achievementnote" type="text" class="form-control" placeholder="Achievement Note">{{$student->studentprofile->achievementnote}}</textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    School Note
  </label>
  <div class="col-sm-9">
    <textarea name="schoolnote" type="text" class="form-control" placeholder="School Note">{{$student->studentprofile->schoolnote}}</textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Previous School Note
  </label>
  <div class="col-sm-9">
    <textarea name="prevschoolnote" type="text" class="form-control" placeholder="Previous School Note">{{$student->studentprofile->prevschoolnote}}</textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    After School Note
  </label>
  <div class="col-sm-9">
    <textarea name="afterschoolnote" type="text" class="form-control" placeholder="After School Note">{{$student->studentprofile->afterschoolnote}}</textarea>
  </div>
</div>
<hr>
<div class="box-header" style="margin: -20px 0px -20px 0px;">
  <h3 class="box-title"><span class="label label-default">Parents Related Info</span></h3>
</div>
<hr>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Father's Name
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->father }}" type="text" placeholder="Father's Name" class="form-control" name="father">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Father's Phone
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->fatherphone }}" type="text" placeholder="Father's Phone" class="form-control" name="fatherphone">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Father's Email
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->fatheremail }}" type="text" placeholder="Father's Email" class="form-control" name="fatheremail">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Mother's Name
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->mother }}" type="text" placeholder="Mother's Name" class="form-control" name="mother">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Mother's Phone
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->motherphone }}" type="text" placeholder="Mother's Phone" class="form-control" name="motherphone">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Mother's Email
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->motheremail }}" type="text" placeholder="Mother's Email" class="form-control" name="motheremail">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Guardian's Name
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->guardian }}" type="text" placeholder="Guardian's Name" class="form-control" name="guardian">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Guardian's Phone
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->guardianphone }}" type="text" placeholder="Guardian's Phone" class="form-control" name="guardianphone">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Guardian's Email
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->guardianemail }}" type="text" placeholder="Guardian's Email" class="form-control" name="guardianemail">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Parents Address
  </label>
  <div class="col-sm-9">
    <input value="{{ $student->studentprofile->parentaddress }}" type="text" placeholder="Parents Address" class="form-control" name="parentaddress">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">
    Parents Note
  </label>
  <div class="col-sm-9">
    <textarea name="parentnote" type="text" class="form-control" placeholder="Parents Note">{{$student->studentprofile->parentnote}}</textarea>
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-3 col-sm-9">
    <!-- Submit Form Button -->
    {!! Form::submit('Save', ['class' => 'btn btn-success btn-xs']) !!}
    <a href="{{ route('students.index') }}" type="button" class="btn btn-default btn-xs">Cancel</a>
  </div>
</div>
