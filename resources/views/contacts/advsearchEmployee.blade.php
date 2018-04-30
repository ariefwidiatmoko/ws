<div id="advsearch">
  <form enctype="multipart/form-data" role="form" action="{{ route('contacts.indexEmployee') }}" method="GET" id="form-advsearch">
    <div class="col-xs-2 form-group">
      <!-- Month -->
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
    <!-- User -->
    <div class="form-group">
      <select class="form-control input-sm" name="user_id">
        <option value="">All Users</option>
        @foreach ($users as $item)
          @if(old('user_id') == $item->id)
          <option value="{{ $item->id }}" selected="selected">{{ ucfirst($item->name) }}</option>
         @else
           <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
         @endif
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-xs-2 form-group">
    <!-- Publish Unpublish -->
    <div class="form-group">
      <select class="form-control input-sm" name="live">
        @if(old('live') == 1)
          <option value="">All Status</option>
          <option value="1" selected="selected">Publish</option>
          <option value="0">Unpublish</option>
        @elseif(old('live') == null)
          <option value="" selected="selected">All Status</option>
          <option value="1">Publish</option>
          <option value="0">Unpublish</option>
        @else
          <option value="">All Status</option>
          <option value="1">Publish</option>
          <option value="0" selected="selected">Unpublish</option>
        @endif
      </select>
    </div>
  </div>
  <div class="col-xs-2 input-group">
    <div class="input-group" style="margin-left: 15px;">
      <input type="text" name="search" class="form-control input-sm pull-right" placeholder="Search Employee..." value="{{old('search')}}">
      <div class="input-group-btn">
        <button type="submit" class="btn btn-default btn-sm">Search</i></button>
      </div>
    </div>
  </div>
</form>
</div>
