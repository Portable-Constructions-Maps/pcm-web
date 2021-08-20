<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">{{ config('app.name') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Manajemen</li>
    {{-- <li class="{{ request()->is('/') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-columns"></i> <span>Dashboard</span></a></li> --}}
    <li class="{{ Route::is('worker.show') ? 'active' : '' }}"><a href="{{route('worker.show')}}"><i class="fas fa-users"></i> <span>Pekerja</span></a></li>
    <li class="{{ Route::is('worker.rooms') ? 'active' : '' }}"><a href="{{route('worker.rooms')}}"><i class="fas fa-map-marker-alt"></i> <span>Area</span></a></li>
    {{-- <li class="{{ Route::is('locations.index') ? 'active' : '' }}"><a href="{{route('locations.index')}}"><i class="fas fa-map-marker-alt"></i> <span>Location</span></a></li> --}}
  </ul>
</aside>
