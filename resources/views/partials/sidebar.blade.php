<!-- partials/sidebar.blade.php -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Manajemen Pegawai -->
    <li class="nav-item {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pegawai.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manajemen Pegawai</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('bagian.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('bagian.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manajemen Bagian</span>
        </a>
    </li>
</ul>
