<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    {{-- Brand – link ke dashboard sesuai role --}}
    @role('admin')
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
            @elserole('pegawai')
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('pegawai.dashboard') }}">
            @endrole
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
        </a>

        <hr class="sidebar-divider my-0">

        {{-- Dashboard --}}
        @role('admin')
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard Admin</span>
                </a>
            </li>
            @elserole('pegawai')
            <li class="nav-item {{ request()->routeIs('pegawai.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard Pegawai</span>
                </a>
            </li>
        @endrole

        <hr class="sidebar-divider">

        {{-- Master Data (hanya admin) --}}
        @role('admin')
            <div class="sidebar-heading">Master Data</div>
            <li class="nav-item {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pegawai.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Manajemen Pegawai</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('bagian.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('bagian.index') }}">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Manajemen Bagian</span>
                </a>
            </li>
            <hr class="sidebar-divider">
        @endrole

        {{-- Aktivitas --}}
        <div class="sidebar-heading">Aktivitas</div>
        @role('pegawai|admin')
            <li class="nav-item {{ request()->routeIs('presensi.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('presensi.index') }}">
                    <i class="fas fa-fw fa-clock"></i>
                    <span>Presensi</span>
                </a>
            </li>
        @endrole

        {{-- Laporan (hanya admin) --}}
        @role('admin')
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Laporan</div>
            <li class="nav-item {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('laporan.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Laporan Presensi</span>
                </a>
            </li>
        @endrole

        @role('admin')
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Pengaturan</div>
            <li class="nav-item {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pengaturan.index') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan Sistem</span>
                </a>
            </li>
        @endrole

</ul>
