<div>
  <div class="col-xs-1 margin form-group" style="margin: -1px 30px -1px -15px;">
    <a href="{{ route('classrooms.create') }}" class="btn btn-sm btn-success">New Classroom</a>
  </div>
  <div class="col-xs-3 margin form-group" style="margin: -1px 8px -1px 40px;">
    <form enctype="multipart/form-data" role="form" action="{{ route('classrooms.yearClassroom') }}" method="POST">
      {{ csrf_field() }}
      <div class="input-group">
        <select class="form-control input-sm" name="year_id">
          <option value="">Select Year</option>
          @foreach ($years as $item)
            <option value="{{ $item->id }}">{{ ucfirst($item->yearname) }}</option>
          @endforeach
        </select>
        <div class="input-group-btn">
          <button type="submit" class="btn btn-success btn-sm">Add Year Academic</button>
        </div>
      </div>
    </form>
  </div>
</div>
