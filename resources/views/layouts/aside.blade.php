<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('logo.png') }}" alt="" height="20">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    @php
                        $role = '';
                        $dashboard = '';
                        if (Auth::User()->role->id == 2) {
                            $dashboard = route('web.dashboard');
                        } else {
                            $dashboard = route('admin.dashboard');
                        }
                    @endphp
                    <a class="nav-link menu-link" href="{{ $dashboard }}" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Beranda</span>
                    </a>
                </li>
                @if (Auth::User()->role->id == 2)
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('web.informations.index') }}" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-information-line"></i>
                            <span data-key="t-informasi">Informasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('web.reviews') }}" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-star-line"></i>
                            <span data-key="t-reviews">Testimoni</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.users.index') }}" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-user-line"></i>
                            <span data-key="t-users">Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.tickets.index') }}" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-ticket-line"></i>
                            <span data-key="t-tickets">Tiket</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.order.index') }}" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-shopping-bag-3-line"></i> <span data-key="t-books">Pesanan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.informations.index') }}" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-information-line"></i>
                            <span data-key="t-informasi">Informasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.reviews') }}" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-star-line"></i>
                            <span data-key="t-reviews">Testimoni</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
