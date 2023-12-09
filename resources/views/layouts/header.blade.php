<header id="page-topbar" class="bg-success">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo mx-5">
                    <a href="{{ route('web.dashboard') }}" class="logo">
                        <span>
                            <img src="{{ asset('logo.png') }}" alt="" class="rounded-circle bg-roun" width="150">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
            @if (Auth::User()->role->id == 2)
                <div class="d-flex align-items-center">
                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="top-cart">
                        <button type="button" onclick="tombol_cart();"
                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-haspopup="true" aria-expanded="false">
                            <lord-icon src="https://cdn.lordicon.com/slkvcfos.json" trigger="loop"
                                style="width:250px;height:250px">
                            </lord-icon>
                            <span
                                class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-danger top-cart-number"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart"
                            aria-labelledby="page-header-cart-dropdown">
                            <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold">PesananKu</h6>
                                    </div>
                                    <div class="col-auto">
                                        <span class="badge badge-soft-warning fs-13"><span
                                                class="cartitem-badge top-cart-number"></span>
                                            Tiket</span>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 300px;">
                                <div class="p-2 top-cart-items">

                                </div>
                            </div>
                            <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border"
                                id="checkout-elem">
                                <div class="d-flex justify-content-between align-items-center pb-3">
                                    <h5 class="m-0 text-muted">Total Harga:</h5>
                                    <div class="px-2">
                                        <h5 class="m-0 top-checkout-price" id="cart-item-total"></h5>
                                    </div>
                                </div>

                                <a href="{{ route('web.cart.index') }}" class="btn btn-primary text-center w-100">
                                    Lihat Daftar PesananKu
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            onclick="tombol_notif();" id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <lord-icon src="https://cdn.lordicon.com/ndydpcaq.json" trigger="loop"
                                style="width:250px;height:250px">
                            </lord-icon>
                            <span
                                class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"
                                id="top-notification-number">
                                <span class="visually-hidden">Notifikasi</span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">

                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white"> Notifikasi </h6>
                                        </div>
                                        <div class="col-auto dropdown-tabs">
                                            <span class="badge badge-soft-light fs-13"
                                                id="top-notification-number"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="notification_items">

                            </div>
                        </div>
                    </div>

                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="top-cart">

                        <button type="button" class="btn btn-ghost-warning rounded-circle"
                            id="page-header-user-dropdown" data-bs-auto-close="outside" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <span class="text-start ms-xl-2">
                                    <i class="bx bx-user text-white fs-22 align-middle me-1"></i>
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-white text-capitalize">{{ Auth::User()->fullname }}</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header">Selamat datang {{ Auth::User()->name }}!</h6>
                            <a class="dropdown-item" href="{{ route('web.order.index') }}">
                                <lord-icon src="https://cdn.lordicon.com/tvyxmjyo.json" trigger="loop"
                                    style="width:30px;height:30px">
                                </lord-icon>
                                <span class="align-middle">History</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('web.logout') }}"><i
                                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            @else
                <div class="d-flex align-items-center">
                    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            onclick="tombol_notif();" id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <lord-icon src="https://cdn.lordicon.com/ndydpcaq.json" trigger="loop"
                                style="width:250px;height:250px">
                            </lord-icon>
                            <span
                                class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"
                                id="top-notification-number">
                                <span class="visually-hidden">Notifikasi</span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">

                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white"> Notifikasi </h6>
                                        </div>
                                        <div class="col-auto dropdown-tabs">
                                            <span class="badge badge-soft-light fs-13"
                                                id="top-notification-number"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="notification_items">

                            </div>
                        </div>
                    </div>
                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="top-cart">

                        <button type="button" class="btn btn-ghost-warning rounded-circle"
                            id="page-header-user-dropdown" data-bs-auto-close="outside" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <span class="text-start ms-xl-2">
                                    <lord-icon src="https://cdn.lordicon.com/dklbhvrt.json" trigger="loop"
                                        style="width:45px;height:45px">
                                    </lord-icon>
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-white text-capitalize">{{ Auth::User()->fullname }}</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header">Welcome {{ Auth::User()->fullname }}!</h6>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</header>
