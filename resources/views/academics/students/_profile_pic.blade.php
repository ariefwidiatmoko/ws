<div class="box-body box-profile">
  @if(empty($student->studentprofile->avatar))
    <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/avatar/default.jpg') }}" alt="User profile picture">
  @else
    <img class="profile-user-img img-responsive img-circle" src="/images/students/{{ $student->studentprofile->avatar }}" alt="User profile picture">
  @endif
  <h3 class="profile-username text-center">{{ ucfirst($student->studentname) }}</h3>
  <p class="text-muted text-center">
    @php
    use Carbon\Carbon;
    if(isset($student->studentprofile->dob)) {
      $nowT = Carbon::now();
      $nextY = Carbon::now()->addYear(1)->format('Y');
      $nowY = Carbon::now()->format('Y');
      $dd = $student->studentprofile->dob->format('d');
      $mm = $student->studentprofile->dob->format('m');
      $nowBd = Carbon::create($nowY, $mm, $dd, 0);
      $nextBd = Carbon::create($nextY, $mm, $dd, 0);
      if($nowBd > Carbon::now()) {
        $bdnow = $nowT->diffInDays($nowBd);
        if ($bdnow <= 72) {
          echo $nowT->diffInDays($nowBd) . 'days until Birthday';
        }
      } else {
        $bdlater = $nowT->diffInDays($nextBd);
        if ($bdlater <= 72) {
          echo $nowT->diffInDays($nextBd) . 'days until Birthday';
        }
      }
    } else {
      echo '-';
    }
    @endphp
  </p>
  <ul class="list-group list-group-unbordered">
    <li class="list-group-item clearfix"><i class="fa fa-phone fa-fw margin-r-5"></i><b>
      Phone</b><a class="pull-right">{{ $student->studentprofile->phone }}</a>
    </li>
    <li class="list-group-item clearfix"><i class="fa fa-envelope fa-fw margin-r-5"></i> <b>
      Email</b><a class="pull-right">{{ $student->studentprofile->email }}</a>
    </li>
    <li class="list-group-item clearfix"><i class="fa fa-map-marker fa-fw margin-r-5"></i><b>
      Address</b><a class="pull-right">{{ $student->studentprofile->address}}</a>
    </li>
    <li class="list-group-item clearfix"><i class="fa fa-mortar-board fa-fw margin-r-5"></i><b>
      Set Alumni</b><a class="pull-right"><input type="checkbox" class="statusActive" data-id="{{$student->id}}" @if ($student->studentactive == 0) checked @endif></a>
    </li>
    <li class="list-group-item clearfix"><i class="fa fa-warning fa-fw margin-r-5"></i><b>
      Delete Student</b><a class="pull-right">
          @can ('delete_students')
            {!! Form::open( ['method' => 'delete', 'url' => route('students.destroy', $student->id), 'onSubmit' => 'return confirm("Are you sure you want to delete ' . ucwords($student->studentname) . ' ?")']) !!}
              <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>
            {!! Form::close() !!}
          @endcan</a>
    </li>
  </ul>
</div>
<!-- /.box-body -->
