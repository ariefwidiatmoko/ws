<div id="advsearch">
  <form enctype="multipart/form-data" role="form" action="{{ route('contacts.indexStudent') }}" method="GET" id="form-advsearch">
    <div class="col-xs-2 form-group">
      <!-- Segment -->
      <div class="form-group">
        <select class="form-control input-sm" name="month_id">
          <option value="">Select Birth Month</option>
          @foreach ($months as $item)
            @if(old('month_id') == $item->noId)
            <option value="{{ $item->noId }}" selected="selected">{{ $item->alias }}</option>
            @else
              <option value="{{ $item->noId }}">{{ $item->alias }}</option>
            @endif
          @endforeach
        </select>
      </div>
    </div>
  <div class="col-xs-2 form-group">
    <!-- Publish Unpublish -->
    <div class="form-group">
      <select class="form-control input-sm" name="studentactive">
        @if(old('studentactive') == 1)
          <option value="">All Status</option>
          <option value="1" selected="selected">Active</option>
          <option value="0">Not Active</option>
        @elseif(old('studentactive') == null)
          <option value="" selected="selected">All Status</option>
          <option value="1">Active</option>
          <option value="0">Not Active</option>
        @else
          <option value="">All Status</option>
          <option value="1">Active</option>
          <option value="0" selected="selected">Not Active</option>
        @endif
      </select>
    </div>
  </div>
  <div class="col-xs-2 input-group">
    <div class="input-group" style="margin-left: 15px;">
      <input type="text" name="studentname" class="form-control input-sm pull-right" placeholder="Search Student Name..." value="{{old('studentname')}}">
      <div class="input-group-btn">
        <button type="submit" class="btn btn-default btn-sm">Search</i></button>
      </div>
    </div>
  </div>
</form>
</div>
