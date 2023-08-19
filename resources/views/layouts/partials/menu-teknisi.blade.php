<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">MASTER</span>
</li>
{{-- <li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('teknisi-downtime.*') ? 'active' : '' }}"
        href="{{ route('teknisi-downtime.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-clock-stop"></i>
        </span>
        <span class="hide-menu">Input Downtime</span>
    </a>
</li> --}}
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('perawatan-mingguan.index*') ? 'active' : '' }}"
        href="{{ route('perawatan-mingguan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-article"></i>
        </span>
        <span class="hide-menu">Perawatan Mingguan</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('perawatan-bulanan.index*') ? 'active' : '' }}"
        href="{{ route('perawatan-bulanan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-article"></i>
        </span>
        <span class="hide-menu">Perawatan Bulanan</span>
    </a>
</li>
