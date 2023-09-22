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
@if (auth()->user()->lokasi_id == '3')
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Presensi</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link"
            href="https://docs.google.com/spreadsheets/d/1pwz3MbO9Hglcd_ug5EHsdvDBEsWYimhzMIMtXye_k5Y/edit#gid=715737916"
            target="_blank"
            aria-expanded="false">
            <span>
                <i class="ti ti-users"></i>
            </span>
            <span class="hide-menu">Presensi</span>
        </a>
    </li>
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">MONITORING BAHAN PENUNJANG AMDK 3</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link"
            href="https://docs.google.com/forms/d/e/1FAIpQLSehb3qighMC_yd6ZaHCv6JKp3KCE9BrJmTh2TMT4UBLemc6UA/viewform"
            target="_blank"
            aria-expanded="false">
            <span>
                <i class="ti ti-tool"></i>
            </span>
            <span class="hide-menu">Solvent Dan Tinta</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link"
            href="https://docs.google.com/forms/d/e/1FAIpQLSdhhn7WHPa0xgX1h35kha7T5nA1x7cBA1rg3H2oFV5QK7Nc-w/viewform"
            target="_blank"
            aria-expanded="false">
            <span>
                <i class="ti ti-tool"></i>
            </span>
            <span class="hide-menu">Technomelt</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link"
            href="https://docs.google.com/forms/d/e/1FAIpQLScKuebPNQbPxiogz8MF3gU2Ex3uVBIpUtkZN6aHQWfd1GIFEw/viewform"
            target="_blank"
            aria-expanded="false">
            <span>
                <i class="ti ti-tool"></i>
            </span>
            <span class="hide-menu">DRYEXX</span>
        </a>
    </li>
@endif
