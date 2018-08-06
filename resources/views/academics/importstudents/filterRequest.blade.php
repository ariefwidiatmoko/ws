<div id="advsearch">
  <form enctype="multipart/form-data" role="form" action="{{ route('importstudents.index') }}" method="GET" id="form-advsearch">
  <div class="col-xs-2 form-group">
    <!-- User -->
    <div class="input-group">
      <div class="input-group-btn">
        <a type="button" href="#" class="btn btn-default btn-sm">Filter</i></a>
      </div>
      <input type="text" name="search" class="form-control input-sm pull-right" placeholder="Student..." value="{{old('search')}}">
    </div>
  </div>
  <div class="col-xs-2 form-group">
    <!-- User -->
    <div class="form-group">
      <select class="form-control input-sm" name="year_id">
        <option value="">Select Year</option>
        @foreach ($years as $item)
          @if(old('year_id') == $item->id)
          <option value="{{ $item->id }}" selected="selected">{{ ucfirst($item->yearname) }}</option>
         @else
           <option value="{{ $item->id }}">{{ ucfirst($item->yearname) }}</option>
         @endif
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-xs-2 form-group">
    <!-- Grade -->
    <div class="input-group">
      <select class="form-control input-sm" name="grade_id">
        <option value="">Select Grade</option>
        @foreach ($grades as $item)
          @if(old('grade_id') == $item->id)
          <option value="{{ $item->id }}" selected="selected">{{ ucfirst($item->gradename) }}</option>
         @else
           <option value="{{ $item->id }}">{{ ucfirst($item->gradename) }}</option>
         @endif
        @endforeach
      </select>
      <div class="input-group-btn">
        <button type="submit" class="btn btn-primary btn-sm">Go!</i></button>
      </div>
    </div>
  </div>
</form>
</div>
