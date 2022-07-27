<!-- Navbar -->
@php 
  $users = Auth::user();
  $user_role = [
    1 => 'Administrator',
    2 => 'Tech',
    3 => 'Help Desk',
    4 => 'Supervisor',
    5 => 'Player',
  ];
@endphp
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <!-- <a href="/home" class="nav-link">Home</a> -->
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      

    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ $users->username }}  ({{ $user_role[$users->user_type_id] }})
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="right: 0 !important;">
          @if($users->user_type_id == 5)
            <a class="dropdown-item" href='/update-password'><i class="fa fa-cog"></i>
                Change Password
            </a>
          @endif
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div class="dropdown">
    </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <h3 class="brand-text font-weight-light">Sample</h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/default-150x150.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $users->first_name . ' ' . $users->last_name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item">
            <a href="/home" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        @if($users->user_type_id != 5)

          @if($users->user_type_id == 1)
          <li class="nav-item">
            <a href="/users" class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
            @if($users->username == 'kikoadmin')
            <li class="nav-item">
              <a href="/api-data" class="nav-link {{ (request()->is('api-data*')) ? 'active' : '' }}">
                <i class="nav-icon fa fa-info"></i>
                <p>
                  Api Data
                </p>
              </a>
            </li>
            @endif

          @endif

          @if(in_array($users->user_type_id, [1,2,3]))
          <li class="nav-item {{ (request()->is('helpdesk*')) ? 'menu-is-opening menu-open' : 'menu-close' }}">
            <a href="#" class="nav-link {{ (request()->is('helpdesk*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Players Management<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/helpdesk" class="nav-link {{ (request()->is('helpdesk')) ? 'custom-active' : '' }}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Verified Players</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/helpdesk/for-approval" class="nav-link {{ (request()->is('helpdesk/for-approval*')) ? 'custom-active' : '' }}">
                <i class="far fa-user nav-icon"></i>
                <p>For Approval</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/helpdesk/for-review" class="nav-link {{ (request()->is('helpdesk/for-review*')) ? 'custom-active' : '' }}">
                <i class="far fa-address-card  nav-icon"></i>
                <p>For Review</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if($users->user_type_id == 4)
          <li class="nav-item">
            <a href="/supervisor" class="nav-link {{ (request()->is('supervisor*')) ? 'active' : '' }}">
              <i class="nav-icon fa fa-address-card"></i>
              <p>
                Supervisor
              </p>
            </a>
          </li>
          <li class="nav-item {{ (request()->is('helpdesk*')) ? 'menu-is-opening menu-open' : 'menu-close' }}">
            <a href="#" class="nav-link {{ (request()->is('helpdesk*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Players Management<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/helpdesk/for-review" class="nav-link {{ (request()->is('helpdesk/for-review*')) ? 'custom-active' : '' }}">
                <i class="far fa-user-circle  nav-icon"></i>
                <p>For Review</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if(in_array($users->user_type_id, [1,2]))
          <li class="nav-item">
            <a href="/reports" class="nav-link {{ (request()->is('reports*')) ? 'active' : '' }}">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          @endif

          @if(in_array($users->user_type_id, [1,2,3]))
          <li class="nav-item">
            <a href="/groups" class="nav-link {{ (request()->is('groups*')) ? 'active' : '' }}">
              <i class="nav-icon fa fa-object-group"></i>
              <p>
                Groups
              </p>
            </a>
          </li>
          @endif
          
          @if($users->user_type_id == 1)
          <li class="nav-item">
            <a href="/activity-logs" class="nav-link {{ (request()->is('activity-logs*')) ? 'active' : '' }}">
              <i class="nav-icon fa fa-list-ol"></i>
              <p>
                Activity Logs
              </p>
            </a>
          </li>
          @endif

          @if(in_array($users->user_type_id, [1,2,3]))

          <li class="nav-item">
            <a href="/blacklist" class="nav-link {{ (request()->is('blacklist*')) ? 'active' : '' }}">
              <i class="nav-icon fa fa-list-alt"></i>
              <p>
                Black/White List
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/notifications" class="nav-link {{ (request()->is('notifications*')) ? 'active' : '' }}">
              
              <i class="nav-icon fa fa-bell">
                <label class="pending-requests" id="pending-requests" style="display:none">
                  <span id="pendingRequests">0</span>
                </label>
              </i>

              <p>
                Notifications
              </p>

            </a>
          </li>

          @endif

        @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>