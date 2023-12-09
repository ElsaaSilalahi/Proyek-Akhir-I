<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Website Pemesanan TIket Masuk Museum TBSC</title>
    <link href="{{ asset('auth/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('auth/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
                style="background-color: #990000">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <!--begin::Content-->
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                        <!--begin::Logo-->
                        <a href="javascript:;" class="py-9 mb-5">
                            <img alt="Logo" src="{{ asset('logo.png') }}" width="250" />
                        </a>
                        <h1 class="fw-bolder fs-2qx pb-5 pb-md-10 text-white">
                            Selamat Datang di Website Pemesanan Tiket Masuk Museum TB Silalahi Center
                        </h1>
                        <p class="fw-bold fs-2 text-white">
                            Website ini dibuat untuk memudahkan pemesanan tiket masuk museum TB Silalahi Center

                        </p>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div id="page_login">
                        <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                            <form class="form" novalidate="novalidate" id="form_login">
                                <div class="text-center mb-10">
                                    <h1 class="text-dark mb-3">Masuk ke {{ config('app.name') }}</h1>
                                    <div class="text-gray-400 fw-bold fs-4">Belum Memiliki Akun?
                                        <a href="javascript:;" onclick="auth_content('page_register');"
                                            class="link-primary fw-bolder">Daftar Sekarang</a>
                                    </div>
                                </div>
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                    <input type="email" class="form-control form-control-solid" name="email"
                                        placeholder="Masukkan Email" />
                                </div>
                                <div class="mb-10">
                                    <div class="d-flex flex-stack mb-2">
                                        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                    </div>
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        name="password" placeholder="Masukkan Password" />
                                </div>
                                <div class="mb-10">
                                    <a id="tombol_login" onclick="login();" class="btn btn-lg btn-primary w-100 mb-5"
                                        href="javascript:;">
                                        <span class="indicator-label">Masuk</span>
                                        <span class="indicator-progress">Silahkan Tunggu...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="page_register">
                        <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                            <form class="form w-100" novalidate="novalidate" id="form_register">
                                <div class="mb-10 text-center">
                                    <h1 class="text-dark mb-3">Buat Akun</h1>
                                    <div class="text-gray-400 fw-bold fs-4">Sudah memiliki akun?
                                        <a href="javascript:;" onclick="auth_content('page_login');"
                                            class="link-primary fw-bolder">Masuk Disini</a>
                                    </div>
                                </div>
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bolder text-dark">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-solid" name="fullname"
                                        placeholder="Masukkan Nama Lengkap" />
                                </div>
                                <div class="mb-10">
                                    <label class="form-label fw-bolder text-dark fs-6">Email</label>
                                    <input class="form-control form-control-lg form-control-solid" type="email"
                                        placeholder="Masukkan Email" name="email" autocomplete="off" />
                                </div>
                                <div class="mb-10">
                                    <label class="form-label fw-bolder text-dark fs-6">No. HP</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text"
                                        placeholder="Masukkan No. HP" name="phone" autocomplete="off" />
                                </div>
                                <div class="mb-10" data-kt-password-meter="true">
                                    <div class="mb-1">
                                        <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid"
                                                type="password" placeholder="Masukkan Password" name="password">
                                            <span
                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                <i class="bi bi-eye-slash fs-2"></i>
                                                <i class="bi bi-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3"
                                            data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                    </div>
                                    <div class="text-muted"><small>Password minimal 8 karakter</small></div>
                                </div>
                                <div class="mb-10">
                                    <label class="form-label fw-bolder text-dark fs-6">Konfirmasi Password</label>
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        placeholder="" name="password_confirmation" autocomplete="off" />
                                </div>
                                <div class="text-center">
                                    <button type="button" id="tombol_register" onclick="register();"
                                        class="btn btn-lg btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="auth/plugins/global/plugins.bundle.js"></script>
    <script src="js/scripts.bundle.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        })
        $(document).ready(function() {
            auth_content('page_login');
        });

        function auth_content(page) {
            $('#page_login').hide();
            $('#page_register').hide();
            $('#' + page).show();
        }

        function login() {
            $('#tombol_login').attr('disabled', true);
            $('#tombol_login').attr("data-kt-indicator", "on");
            var form = $('#form_login');
            $.ajax({
                url: "{{ route('login') }}",
                type: "POST",
                data: form.serialize(),
                success: function(response) {
                    if (response.alert == 'success') {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            window.location.href = response.redirect;
                        });
                    } else {
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                    $('#tombol_login').attr('disabled', false);
                    $('#tombol_login').removeAttr("data-kt-indicator");
                }
            });
        }

        function register() {
            $('#tombol_register').attr('disabled', true);
            $('#tombol_register').attr("data-kt-indicator", "on");
            var form = $('#form_register');
            $.post("{{ route('register') }}", $(form).serialize(), function(result) {
                if (result.alert == "success") {
                    Swal.fire({
                        text: result.message,
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        },
                    });
                    $(form)[0].reset();
                    auth_content('page_login');
                } else {
                    Swal.fire({
                        text: result.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
                $('#tombol_register').attr('disabled', false);
                $('#tombol_register').removeAttr("data-kt-indicator");
            });
        }
    </script>
</body>
<!--end::Body-->

</html>
