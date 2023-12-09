@extends('layouts.master')
@section('title', 'Beranda')
@section('content')
    <div id="content_list">
        <h5>Beranda</h5>
        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                    Pengguna
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $total_user }}">{{ $total_user }}</span>
                                    </span>
                                </h4>
                                <a href="{{ route('admin.users.index') }}" class="text-decoration-underline">
                                    Lihat Detail
                                </a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info rounded fs-3">
                                    <i class="bx bx-user-circle text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                    Pesanan
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value"
                                        data-target="{{ $total_order }}">{{ $total_order }}</span>
                                    </span>
                                </h4>
                                <a href="{{ route('admin.order.index') }}" class="text-decoration-underline">
                                    Lihat Detail
                                </a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-primary rounded fs-3">
                                    <i class="bx bx-cart text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="invoiceList">
                    <div class="card-header border-0">
                        <div class="card-body">
                            <div>
                                <div class="table-responsive text-center container">
                                    <lord-icon src="https://cdn.lordicon.com/eszyyflr.json" trigger="loop"
                                        style="width:130px;height:130px">
                                    </lord-icon>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <h2 class="mb-0 flex-grow-1 text-center">Welcome Back {{ Auth::user()->fullname }}!</h2>
                        </div><br>
                        <div class="d-flex align-items-center justify-content-center pb-5">
                            <h4 class="mb-0 flex-grow-1 text-center">Museum TB Silalahi Center</h4>
                        </div>
                    </div>

                </div>

            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <div id="content_detail"></div>
@endsection
