<tr>
  <?php
    $per_found = null;

    if( isset($role) ) {
      $per_found = $role->hasPermissionTo($perm->name);
    }

    if( isset($user)) {
      $per_found = $user->hasDirectPermission($perm->name);
    }
  ?>
  <td style="text-align: center;">{{ $loop->iteration }}</td>
  <td style="color:{{ str_contains($perm->name, 'delete') ? 'red' : '' }}">{!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}</td>
</tr>
