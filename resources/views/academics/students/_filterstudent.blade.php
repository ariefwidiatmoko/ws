<div id="advsearch">
  <form enctype="multipart/form-data" role="form" action="{{ route('students.index') }}" method="GET" id="form-advsearch">
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
        @if (empty($request->year_id))
          @foreach ($years as $item)
            <option value="{{ $item->id }}" @if($yearactive->year_id == $item->id) selected="selected" @endif>{{ ucfirst($item->yearname) }}</option>
          @endforeach
        @else
          @foreach ($years as $item)
            <option value="{{ $item->id }}" @if(old('year_id') == $item->id) selected="selected" @endif>{{ ucfirst($item->yearname) }}</option>
          @endforeach
        @endif
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
