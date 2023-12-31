@if (auth()->user()->role == '1' || auth()->user()->role == '2')
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">MASTER</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('lokasi.*') ? 'active' : '' }}"
            href="{{ route('lokasi.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-current-location"></i>
            </span>
            <span class="hide-menu">lokasi</span>
        </a>
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
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('mesin.*') ? 'active' : '' }}"
            href="{{ route('mesin.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-hammer"></i>
            </span>
            <span class="hide-menu">Mesin</span>
        </a>
    </li>
@endif
@if (auth()->user()->role == '1')
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('shift.*') ? 'active' : '' }}"
            href="{{ route('shift.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-clock"></i>
            </span>
            <span class="hide-menu">Shift</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('jamkerja.*') ? 'active' : '' }}"
            href="{{ route('jamkerja.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-clock"></i>
            </span>
            <span class="hide-menu">Jam Kerja</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('downtime.*') ? 'active' : '' }}"
            href="{{ route('downtime.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-clock-stop"></i>
            </span>
            <span class="hide-menu">Jenis Downtime</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('sparepart.*') ? 'active' : '' }}"
            href="{{ route('sparepart.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-tool"></i>
            </span>
            <span class="hide-menu">Spare Part</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('jenis-kegiatan.*') ? 'active' : '' }}"
            href="{{ route('jenis-kegiatan.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">Jenis Kegiatan</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('line-produksi.*') ? 'active' : '' }}"
            href="{{ route('line-produksi.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-map"></i>
            </span>
            <span class="hide-menu">Line Produksi</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('reject.index') ? 'active' : '' }}"
            href="{{ route('reject.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Data Reject</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('admin-produksi.index') ? 'active' : '' }}"
            href="{{ route('admin-produksi.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Data Produksi</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('request-perbaikan.*') ? 'active' : '' }}"
            href="{{ route('request-perbaikan.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-star"></i>
            </span>
            <span class="hide-menu">Request Perbaikan</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('report-suhu.*') ? 'active' : '' }}"
            href="{{ route('report-suhu.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-menu">Monitoring Suhu</span>
        </a>
    </li>
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">REPORT</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ request()->routeIs('report-presensi.*') ? 'active' : '' }}"
            href="{{ route('report-presensi.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-star"></i>
            </span>
            <span class="hide-menu">Report Presensi</span>
        </a>
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
    <li class="sidebar-item mb-5">
        <a class="sidebar-link {{ request()->routeIs('maintenance-bulanan.*') ? 'active' : '' }}"
            href="{{ route('maintenance-bulanan.index') }}"
            aria-expanded="false">
            <span>
                <i class="ti ti-alarm"></i>
            </span>
            <span class="hide-menu">Maintenance Bulanan</span>
        </a>
    </li>
@endif
