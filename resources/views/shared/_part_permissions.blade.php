<div class="row-fluid">
  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Users</th>
      </tr>
    </thead>
      <tbody>
        @foreach($permUsers as $perm)
        @include('shared._part_perm')
        @endforeach
      </tbody>
  </table>
  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Profiles</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permProfiles as $perm)
      @include('shared._part_perm')
      @endforeach
    </tbody>
  </table>
  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Roles</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permRoles as $perm)
      @include('shared._part_perm')
      @endforeach
    </tbody>
  </table>
  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Permissions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permPermissions as $perm)
      @include('shared._part_perm')
      @endforeach
    </tbody>
  </table>
  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Lessons</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permLessons as $perm)
      @include('shared._part_perm')
      @endforeach
    </tbody>
  </table>
  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Subjects</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permSubjects as $perm)
      @include('shared._part_perm')
      @endforeach
    </tbody>
  </table>

  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Notes</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permNotes as $perm)
      @include('shared._part_perm')
      @endforeach
    </tbody>
  </table>

  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Filemanager</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permFilemanager as $perm)
      @include('shared._part_perm')
      @endforeach
    </tbody>
  </table>

  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Employees</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permEmployees as $perm)
      @include('shared._part_perm')
      @endforeach
    </tbody>
  </table>

  <table class="table table-responsive table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center; width: 20px;"><i class="fa fa-check-square fa-fw"></i></th>
        <th>Messages</th>
      </tr>
    </thead>
    <tbody>
      @foreach($permMessages as $perm)
      @include('shared._part_perm')
      @endforeach
    </tbody>
  </table>
</div>
