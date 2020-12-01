
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="/dapur">
          <img src="{{asset('/assets/img/brand/brand-01.png')}}" class="navbar-brand-img" width="180" height="55" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/dapur/super/dashboard" id="dashboard">
                <i class="ni ni-laptop text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/dapur/super/view" id="users">
                <i class="ni ni-circle-08 text-primary"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/dapur/super/roles" id="roles">
                <i class="ni ni-badge text-primary"></i>
                <span class="nav-link-text">Roles</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/dapur/super/permission" id="permission">
                <i class="ni ni-key-25 text-primary"></i>
                <span class="nav-link-text">Permission</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/dapur/super/menu" id="menu">
                <i class="ni ni-bullet-list-67 text-primary"></i>
                <span class="nav-link-text">Menu</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
</nav>
