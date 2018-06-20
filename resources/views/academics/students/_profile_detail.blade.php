<!-- About Me Box -->
<div class="box box-default" style="margin-top: -20px;">
  <div class="box-header with-border">
    <h3 class="box-title">Detail Profile</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <strong><i class="fa fa-newspaper-o margin-r-5"></i>
    Place & Date of Birth</strong>
    <p class="text-muted">{{ucfirst($student->studentprofile->pob)}}{{ $student->studentprofile->dob != null ? ', '.$student->studentprofile->dob->format('d M Y') : ''}}</p>
    <hr>
    <strong><i class="fa fa-venus-mars margin-r-5"></i>
    Gender</strong>
    <p class="text-muted">@if (isset($student->studentprofile->gender))
      {{$student->studentprofile->gender == 1 ? 'Male' : 'Female'}}
    @endif</p>
    <hr>
    <strong><i class="fa fa-flag margin-r-5"></i>
    Citizenship</strong>
    <p class="text-muted">{{ucfirst($student->studentprofile->citizenship)}}</p>
    <hr>
    <strong><i class="fa fa-users margin-r-5"></i>
    Siblings</strong>
    <p class="text-muted">{{ucfirst($student->studentprofile->siblings)}}</p>
    <hr>
    <strong><i class="fa fa-sitemap margin-r-5"></i>
    Family Status / Child No</strong>
    <p class="text-muted">{{ucfirst($student->studentprofile->familystatus)}} {{$student->studentprofile->childno != null ? '/ No '.$student->studentprofile->childno : ''}}</p>
    <hr>
    <strong><i class="fa fa-commenting margin-r-5"></i>
    Family Notes</strong>
    <p>{{ $student->studentprofile->familiynote }}</p>
    <hr>
    <strong><i class="fa fa-heart margin-r-5"></i>
    Health Notes</strong>
    <p>{{ $student->studentprofile->healthnote }}</p>
    <hr>
    <strong><i class="fa fa-reply margin-r-5"></i>
    Previous School</strong>
    <p>{{ $student->studentprofile->prevschool }}</p>
    <hr>
    <strong><i class="fa fa-trophy margin-r-5"></i>
    Achievement Note</strong>
    <p>{{ $student->studentprofile->achievementnote }}</p>
    <hr>
    <strong><i class="fa fa-commenting margin-r-5"></i>
    School Note</strong>
    <p>{{ $student->studentprofile->schoolnote }}</p>
    <hr>
    <strong><i class="fa fa-commenting margin-r-5"></i>
    Previous School Note</strong>
    <p>{{ $student->studentprofile->prevschoolnote }}</p>
    <hr>
    <strong><i class="fa fa-commenting margin-r-5"></i>
    After School Note</strong>
    <p>{{ $student->studentprofile->afterschoolnote }}</p>
    <hr>
    <strong><i class="fa  fa-user margin-r-5"></i>
    Father's Name</strong>
    <p>{{ $student->studentprofile->father }}</p>
    <hr>
    <strong><i class="fa fa-phone margin-r-5"></i>
    Father's Phone</strong>
    <p>{{ $student->studentprofile->fatherphone }}</p>
    <hr>
    <strong><i class="fa fa-envelope margin-r-5"></i>
    Father's Email</strong>
    <p>{{ $student->studentprofile->fatheremail }}</p>
    <hr>
    <strong><i class="fa  fa-user margin-r-5"></i>
    Mother's Name</strong>
    <p>{{ $student->studentprofile->mother }}</p>
    <hr>
    <strong><i class="fa fa-phone margin-r-5"></i>
    Mother's Phone</strong>
    <p>{{ $student->studentprofile->motherphone }}</p>
    <hr>
    <strong><i class="fa fa-envelope margin-r-5"></i>
    Mother's Email</strong>
    <p>{{ $student->studentprofile->motheremail }}</p>
    <hr>
    <strong><i class="fa  fa-user margin-r-5"></i>
    Guardian's Name</strong>
    <p>{{ $student->studentprofile->guardian }}</p>
    <hr>
    <strong><i class="fa fa-phone margin-r-5"></i>
    Guardian's Phone</strong>
    <p>{{ $student->studentprofile->guardianphone }}</p>
    <hr>
    <strong><i class="fa fa-envelope margin-r-5"></i>
    Guardian's Email</strong>
    <p>{{ $student->studentprofile->guardianemail }}</p>
    <hr>
    <strong><i class="fa fa-map-marker margin-r-5"></i>
    Parent's Address</strong>
    <p>{{ $student->studentprofile->parentaddress }}</p>
    <hr>
    <strong><i class="fa fa-commenting margin-r-5"></i>
    Parent's Note</strong>
    <p>{{ $student->studentprofile->parentnote }}</p>
    <hr>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
