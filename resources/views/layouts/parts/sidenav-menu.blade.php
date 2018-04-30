<!-- sidebar menu -->
@if (Auth::check())
  {{ csrf_field() }}
  <ul class="sidebar-menu" data-widget="tree">
    <li class="{{ \Request::is('home') ? 'active' : null }}"><a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i><span>
      Dashboard</span></a>
    </li>
    @can('view_lessons', 'view_subjects', 'view_notes')
    <li class="treeview {{ \Request::is('home/contents/*') ? 'active' : null }}"><a href="#"><i class="fa fa-edit fa-fw"></i>
      <span>Contents</span><span class="pull-right-container"><i class="fa fa-angle-left fa-fw pull-right"></i></span></a>
      <ul class="treeview-menu">
        @can('view_lessons')
          <li id="{{ Request::is('home/contents/lessons*') ? 'sub-menu' : '' }}"><a href="{{ route('lessons.index') }}"><i class="fa fa-angle-right fa-fw"></i>
            Lessons</a>
          </li>
        @endcan
        @can('view_subjects')
          <li id="{{ Request::is('home/contents/subjects*') ? 'sub-menu' : '' }}"><a href="{{ route('subjects.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Subjects</a>
          </li>
        @endcan
        @can('view_notes')
          <li id="{{ Request::is('home/contents/notes*') ? 'sub-menu' : '' }}"><a href="{{ route('notes.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Notes</a>
          </li>
        @endcan
        @can('view_filemanager')
          <li id="{{ \Request::is('home/contents/filemanager') ? 'sub-menu' : '' }}"><a href="{{ route('filemanager') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            File Manager</a>
          </li>
        @endcan
      </ul>
    </li>
    @endcan
    @can('view_contacts_students', 'view_contacts_employees', 'view_messages')
    <li class="treeview {{ \Request::is('home/contacts/*') ? 'active' : null }}"><a href="#"><i class="fa fa-phone-square fa-fw"></i>
      <span>Contacts</span><span class="pull-right-container"><i class="fa fa-angle-left fa-fw pull-right"></i></span></a>
      <ul class="treeview-menu">
        @can('view_contacts_students')
          <li id="{{ Request::is('home/contacts/students*') ? 'sub-menu' : '' }}"><a href="{{ route('contacts.indexStudent') }}"><i class="fa fa-angle-right fa-fw"></i>
            Students</a>
          </li>
        @endcan
        @can('view_contacts_employees')
          <li id="{{ Request::is('home/contacts/employees*') ? 'sub-menu' : '' }}"><a href="{{ route('contacts.indexEmployee') }}"><i class="fa fa-angle-right fa-fw"></i>
            Employees</a>
          </li>
        @endcan
        @can('view_messages')
          <li id="{{ Request::is('home/contacts/messages*') ? 'sub-menu' : '' }}"><a href="{{ route('messages.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Messages</a>
          </li>
        @endcan
      </ul>
    </li>
    @endcan
    @can ('view_events')
      <li class="{{ \Request::is('home/events') ? 'active' : null }}"><a href="{{ route('events.index')}}" class="load-menu"><i class="fa fa-calendar fa-fw"></i><span> Events</span></a></li>
    @endcan
    @can('view_students', 'view_employees', 'view_positions')
    <li class="treeview {{ \Request::is('home/administration/*') ? 'active' : null }}"><a href="#"><i class="fa fa-newspaper-o fa-fw"></i>
      <span>Administrations</span><span class="pull-right-container"><i class="fa fa-angle-left fa-fw pull-right"></i></span></a>
      <ul class="treeview-menu">
        @can('view_contacts_students')
          <li id="{{ Request::is('home/administration/students*') ? 'sub-menu' : '' }}"><a href="{{ route('students.index') }}"><i class="fa fa-angle-right fa-fw"></i>
            Students</a>
          </li>
        @endcan
        @can('view_employees')
          <li id="{{ Request::is('home/administration/employees*') ? 'sub-menu' : '' }}"><a href="{{ route('employees.index') }}"><i class="fa fa-angle-right fa-fw"></i>
            Employees</a>
          </li>
        @endcan
        @can('view_positions')
          <li id="{{ Request::is('home/administration/positions*') ? 'sub-menu' : '' }}"><a href="{{ route('positions.index') }}"><i class="fa fa-angle-right fa-fw"></i>
            Positions</a>
          </li>
        @endcan
      </ul>
    </li>
    @endcan
    @can('view_users', 'view_profiles', 'view_permissions', 'view_roles')
    <li class="treeview {{ \Request::is('home/userm/*') ? 'active' : null }}"><a href="#"><i class="fa fa-user-plus"></i><span>
      Users Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
      <ul class="treeview-menu">
        @can('view_users')
          <li id="{{ Request::is('home/userm/users*') ? 'sub-menu' : '' }}"><a href="{{ route('users.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Users</a>
          </li>
        @endcan
        @can('view_profiles')
          <li id="{{ Request::is('home/userm/profiles*') ? 'sub-menu' : '' }}"><a href="{{ route('profiles.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Profiles</a>
          </li>
        @endcan
        @can('view_permissions')
          <li id="{{ Request::is('home/userm/permissions*') ? 'sub-menu' : '' }}"><a href="{{ route('permissions.index') }}"  class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Permissions</a>
          </li>
        @endcan
        @can('edit_users')
          <li id="{{ Request::is('home/userm/roles*') ? 'sub-menu' : '' }}"><a href="{{ route('roles.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Roles</a>
          </li>
        @endcan
      </ul>
    </li>
    @endcan
    @can('view_users', 'view_profiles', 'view_permissions', 'view_roles')
    <li class="treeview {{ \Request::is('home/settings/*') ? 'active' : null }}"><a href="#"><i class="fa fa-sliders fa-fw"></i><span>
      Settings</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
      <ul class="treeview-menu">
        @can('view_years')
          <li id="{{ Request::is('home/settings/years*') ? 'sub-menu' : '' }}"><a href="{{ route('years.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Years</a>
          </li>
        @endcan
        @can('view_semesters')
          <li id="{{ Request::is('home/settings/semesters*') ? 'sub-menu' : '' }}"><a href="{{ route('semesters.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Semesters</a>
          </li>
        @endcan
        @can('view_grades')
          <li id="{{ Request::is('home/settings/grades*') ? 'sub-menu' : '' }}"><a href="{{ route('grades.index') }}"  class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Grades</a>
          </li>
        @endcan
        @can('edit_classrooms')
          <li id="{{ Request::is('home/settings/classrooms*') ? 'sub-menu' : '' }}"><a href="{{ route('classrooms.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Classrooms</a>
          </li>
        @endcan
        @can('edit_students')
          <li id="{{ Request::is('home/settings/setstudents*') ? 'sub-menu' : '' }}"><a href="{{ route('setstudents.index') }}" class="load-menu"><i class="fa fa-angle-right fa-fw"></i>
            Students</a>
          </li>
        @endcan
      </ul>
    </li>
    @endcan
    <li class="{{ \Request::is('home/settings/importcsv/students') ? 'active' : null }}"><a href="{{ route('importcsv.student')}}" class="load-menu"><i class="fa fa-download fa-fw"></i><span> Import Students</span></a></li>
    @can ('edit_users')
      <li class="{{ \Request::is('home/users/change-password*') ? 'active' : null }}"><a href="{{ route('users.changePassword', Auth::user()->id) }}" class="load-menu"><i class="fa fa-unlock-alt fa-fw"></i><span> Change Password</span></a></li>
    @endcan
  </ul>
@endif