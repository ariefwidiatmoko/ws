<!-- About Me Box -->
<div class="box box-default" style="margin-top: -20px;">
  <div class="box-header with-border" style="margin-left: 14px;">
    <h3 class="box-title">History Academic</h3>
    <a href="#" id="addyear" data-id="{{$student->id}}" class="btn btn-xs btn-info pull-right">Add</a>
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
        @php
          $i = 1;
        @endphp
        @forelse ($histories as $index => $item)
        <tr>
          <td>{{$i}}</td>
          <td>{{$item->yearname}}</td>
          <td>{{$item->semestername}}</td>
          <td>{{$item->gradename}}</td>
          <td class="item{{$index}}">{!!$item->classroomname ? $item->classroomname . ' <a class="edit-modal btn btn-xs" href="#" data-id="'. $item->id. '" data-student_id="'. $item->student_id. '"><i class="fa fa-pencil fa-fw"></i></a>' : '<button class="edit-modal btn btn-xs" href="#" data-id="'. $item->id. '" data-index="'. $index . '" data-student_id="'. $item->student_id. '">Set</button>'!!}</td>
          <td>
            {!! Form::open( ['method' => 'delete', 'url' => route('students.destroy', $item->id), 'onSubmit' => 'return confirm("Are you sure you want to delete it?")']) !!}
              <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>
            {!! Form::close() !!}
          </td>
        </tr>
        @php
          $i++;
        @endphp
      @empty
        <tr><td>No Data</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
