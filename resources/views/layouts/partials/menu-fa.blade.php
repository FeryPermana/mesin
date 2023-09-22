<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">MASTER</span>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('produksi-karu.create') ? 'active' : '' }}"
        href="{{ route('produksi-karu.create') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-layout-dashboard"></i>
        </span>
        <span class="hide-menu">Input Produksi</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ request()->routeIs('produksi-karu.index') ? 'active' : '' }}"
        href="{{ route('produksi-karu.index') }}"
        aria-expanded="false">
        <span>
            <i class="ti ti-layout-dashboard"></i>
        </span>
        <span class="hide-menu">Data Produksi</span>
    </a>
</li>
