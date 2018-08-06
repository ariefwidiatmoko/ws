<!-- Detail Score Name -->
<div class="form-group @if ($errors->has('detailname')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
  <label>Detail Score</label>
  <input type="text" class="form-control" name="detailname" value="{{$detail->detailname}}" required>
</div>
@if ($errors->has('detailname')) <p class="help-block">{{ $errors->first('detailname') }}</p> @endif

<!-- Detail Score Description -->
<div class="form-detail @if ($errors->has('detaildescription')) has-error @endif" style="margin-left: 1px; margin-right: 1px;">
  <label>Detail Score Description</label>
  <input type="text" class="form-control" name="detaildescription" value="{{$detail->detaildescription}}">
</div>
@if ($errors->has('detaildescription')) <p class="help-block">{{ $errors->first('detaildescription') }}</p> @endif
