<!-- About Me Box -->
<div class="box box-default" style="margin-top: -20px;">
  <div class="box-header with-border" style="margin-left: 14px;">
    <h3 class="box-title">History Academic</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive" style="margin-left: 14px;">
    <table class="table table-hover" style="margin-top: -10px;">
      <tbody>
        <tr>
          <td>No</td>
          <td>Year</td>
          <td>Semester</td>
          <td>Grade</td>
          <td>Classroom</td>
        </tr>
        @forelse ($histories as $index => $item)
        <tr>
          <td>{{$index += 1}}</td>
          <td>{{$item->yearname}}</td>
          <td>{{$item->semestername}}</td>
          <td>{{$item->gradename}}</td>
          <td class="item{{$index}}">{!!$item->classroomname ? $item->classroomname . ' (<a class="edit-modal btn btn-xs" href="#" data-id="'. $item->id. '" data-index="'. $index . '" data-student_id="'. $item->student_id. '">Change</a>)' : '<button class="edit-modal btn btn-xs" href="#" data-id="'. $item->id. '" data-index="'. $index . '" data-student_id="'. $item->student_id. '">Set</button>'!!}</td>
        </tr>
      @empty
        <tr><td>No Data</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
