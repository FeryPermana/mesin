<nav class="sidebar-nav scroll-sidebar"
    data-simplebar="">
    <ul id="sidebarnav">
        {{-- <li class="sidebar-item">
            <a class="sidebar-link"
                href="./index.html"
                aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li> --}}
        @if (auth()->user()->role == '1')
            @include('layouts.partials.menu-supadm')
        @endif
        @if (auth()->user()->role == '2')
            @include('layouts.partials.menu-kabag')
        @endif
        @if (auth()->user()->role == '3')
            @include('layouts.partials.menu-teknisi')
        @endif
        @if (auth()->user()->role == '4')
            @include('layouts.partials.menu-fa')
        @endif
        @if (auth()->user()->role == '5')
            @include('layouts.partials.menu-operator')
        @endif
    </ul>
</nav>
