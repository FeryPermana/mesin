<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('operator-downtime.*') ? 'active' : '' }}"
        href="{{ route('operator-downtime.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-clock-stop"></i>
        </span>
        <span class="hide-menu">Input DownTime</span>
    </a>
</li>
{{-- <li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Perawatan</span>
</li> --}}
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('perawatan.index.*') ? 'active' : '' }}"
        href="{{ route('perawatan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-article"></i>
        </span>
        <span class="hide-menu">Perawatan Harian</span>
    </a>
</li>