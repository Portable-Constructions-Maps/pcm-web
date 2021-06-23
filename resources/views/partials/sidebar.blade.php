<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">{{ config('app.name') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ request()->is('/') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-columns"></i> <span>Dashboard</span></a></li>
    <li class="{{ request()->is('/worker/show') ? 'active' : '' }}"><a href="{{route('worker.show')}}"><i class="fas fa-table"></i> <span>Pekerja</span></a></li>
    <li class="{{ request()->is('/worker/rooms') ? 'active' : '' }}"><a href="{{route('worker.rooms')}}"><i class="fas fa-table"></i> <span>Area</span></a></li>
    <li class="menu-header">Users</li>
    <li><a class="nav-link" href=""><i class="fas fa-users"></i> <span>Users</span></a></li>
  </ul>
</aside>
