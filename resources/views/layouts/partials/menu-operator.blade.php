<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('reject-operator.create') ? 'active' : '' }}"
        href="{{ route('reject-operator.create') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-layout-dashboard"></i>
        </span>
        <span class="hide-menu">Input Reject</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('reject-operator.index') ? 'active' : '' }}"
        href="{{ route('reject-operator.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-layout-dashboard"></i>
        </span>
        <span class="hide-menu">Data Reject</span>
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
@if (auth()->user()->lokasi_id == '3')
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
@endif
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('perawatan.*') ? 'active' : '' }}"
        href="{{ route('perawatan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-article"></i>
        </span>
        <span class="hide-menu">Perawatan Harian</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('operator-perbaikan.*') ? 'active' : '' }}"
        href="{{ route('operator-perbaikan.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-article"></i>
        </span>
        <span class="hide-menu">Permintaan Perbaikan</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('monitoring-suhu.*') ? 'active' : '' }}"
        href="{{ route('monitoring-suhu.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-aperture"></i>
        </span>
        <span class="hide-menu">Monitoring Suhu</span>
    </a>
</li>
