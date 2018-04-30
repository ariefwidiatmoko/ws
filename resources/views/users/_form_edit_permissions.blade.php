  <div class="panel box" style="border: 1px solid #d2d6de;">
    <div class="box-header">
      <h4 class="box-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
          <h5><b>Override Permissions</b> {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!} <i class="fa fa-caret-down"></i></h5>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
      <div class="box-body">
        @include('shared._part_permissions')
      </div>
    </div>
  </div>
