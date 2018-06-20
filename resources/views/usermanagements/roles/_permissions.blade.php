<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
    <h4 class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="{{ $closed or 'true' }}" aria-controls="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <b>"{{ $title }}"</b> permissions
      </a>
    </h4>
  </div>
  <div class="panel-collapse">
    <div class="panel-body">
      @if ($role->name == 'Admin')

      @else
        <div class="form-group">
          <label>Role Name</label>
            <input type="text" class="form-control" name="name" value="{{ $role->name }}" autofocus>
        </div>
      @endif
        @include('shared._part_permissions')
      </div>
    </div>
  </div>
