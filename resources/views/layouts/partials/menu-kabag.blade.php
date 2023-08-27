<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">MASTER</span>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('user.*') ? 'active' : '' }}"
        href="{{ route('user.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-user"></i>
        </span>
        <span class="hide-menu">User</span>
    </a>
</li>
<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">REPORT</span>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('maintenance-downtime.*') ? 'active' : '' }}"
        href="{{ route('maintenance-downtime.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-article"></i>
        </span>
        <span class="hide-menu">Maintenance Downtime</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('maintenance-harian.*') ? 'active' : '' }}"
        href="{{ route('maintenance-harian.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-alarm"></i>
        </span>
        <span class="hide-menu">Maintenance Harian</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('maintenance-mingguan.*') ? 'active' : '' }}"
        href="{{ route('maintenance-mingguan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-alarm"></i>
        </span>
        <span class="hide-menu">Maintenance Mingguan</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('maintenance-bulanan.*') ? 'active' : '' }}"
        href="{{ route('maintenance-bulanan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-alarm"></i>
        </span>
        <span class="hide-menu">Maintenance Bulanan</span>
    </a>
</li>
