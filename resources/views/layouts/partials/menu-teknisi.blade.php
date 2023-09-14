<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">MASTER</span>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('teknisi-downtime.*') ? 'active' : '' }}"
        href="{{ route('teknisi-downtime.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-clock-stop"></i>
        </span>
        <span class="hide-menu">Input Downtime</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('tutorial-mesin.*') ? 'active' : '' }}"
        href="{{ route('tutorial-mesin.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-video"></i>
        </span>
        <span class="hide-menu">Tutorial Mesin</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('presensi.*') ? 'active' : '' }}"
        href="{{ route('presensi.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-star"></i>
        </span>
        <span class="hide-menu">Presensi</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('teknisi-sparepart.*') ? 'active' : '' }}"
        href="{{ route('teknisi-sparepart.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-tool"></i>
        </span>
        <span class="hide-menu">Spare Part</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('perawatan-mingguan.*') ? 'active' : '' }}"
        href="{{ route('perawatan-mingguan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-article"></i>
        </span>
        <span class="hide-menu">Perawatan Mingguan</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('perawatan-bulanan.*') ? 'active' : '' }}"
        href="{{ route('perawatan-bulanan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-article"></i>
        </span>
        <span class="hide-menu">Perawatan Bulanan</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('teknisi-perbaikan.*') ? 'active' : '' }}"
        href="{{ route('teknisi-perbaikan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-article"></i>
        </span>
        <span class="hide-menu">Permintaan Perbaikan</span>
    </a>
</li>
