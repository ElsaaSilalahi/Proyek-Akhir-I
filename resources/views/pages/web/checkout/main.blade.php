@extends('layouts.master')
@section('title', 'Checkout')
@section('content')
    <div id="content_list">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Checkout</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Checkout</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form id="form_checkout" action="{{ route('web.checkout') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body checkout-tab">
                            <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                                <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab"
                                            aria-controls="pills-bill-info" aria-selected="true"><i
                                                class="ri-user-2-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                            Info Pribadi</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fs-15 p-3" id="pills-bill-address-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-bill-address" type="button" role="tab"
                                            aria-controls="pills-bill-address" aria-selected="false"><i
                                                class="ri-wallet-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                            Metode Pembayaran</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fs-15 p-3" id="pills-payment-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-payment" type="button" role="tab"
                                            aria-controls="pills-payment" aria-selected="false"><i
                                                class="ri-bank-card-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                            Info Pembayaran</button>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel"
                                    aria-labelledby="pills-bill-info-tab">
                                    <div>
                                        <h5 class="mb-1">Info Pribadi</h5>
                                        <p class="text-muted mb-4">Silakan isi semua informasi di bawah ini</p>
                                    </div>

                                    <div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="fullname" class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                                        placeholder="Enter first name"
                                                        value="{{ Auth::user()->fullname }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Enter email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="Enter phone" value="{{ Auth::user()->phone }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3 mt-3">
                                            <button type="button" class="btn btn-primary btn-label right ms-auto nexttab"
                                                data-nexttab="pills-bill-address-tab"><i
                                                    class="ri-bank-card-line label-icon align-middle fs-16 ms-2"></i>
                                                Lanjutkan
                                                ke metode pembayaran</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-bill-address" role="tabpanel"
                                    aria-labelledby="pills-bill-address-tab">
                                    <div>
                                        <h5 class="mb-1">Pilih Metode Pembayaran</h5>
                                        <p class="text-muted mb-4">Pilih metode pembayaran yang tersedia</p>
                                    </div>

                                    <div class="row g-4 justify-content-evenly">
                                        <div class="col-lg-6 col-sm-6">
                                            <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse"
                                                aria-expanded="true" aria-controls="paymentmethodCollapse">
                                                <div class="form-check card-radio">
                                                    <input id="shippingMethod02" name="payment" type="radio"
                                                        value="Bank Transfer" class="form-check-input" checked>
                                                    <label class="form-check-label" for="shippingMethod02">
                                                        <span
                                                            class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">Bank
                                                            Transfer</span>
                                                        <span class="fs-14 mb-1 text-wrap d-block">BNI</span>
                                                        <span class="text-muted fw-normal text-wrap d-block">Rek.
                                                            0375410953</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show"
                                                aria-expanded="false" aria-controls="paymentmethodCollapse">
                                                <div class="form-check card-radio">
                                                    <input id="shippingMethod01" name="payment" type="radio" value="Cash"
                                                        class="form-check-input">
                                                    <label class="form-check-label" for="shippingMethod01">
                                                        <span
                                                            class="fs-20 float-end mt-2 text-wrap d-block fw-semibold">Cash/Tunai</span>
                                                        <span class="fs-14 mb-1 text-wrap d-block">Cash</span>
                                                        <span class="text-muted fw-normal text-wrap d-block">Bayar ke
                                                            Loket</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button" class="btn btn-light btn-label previestab"
                                            data-previous="pills-bill-info-tab">
                                            <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                            Kembali ke Info Pribadi</button>
                                        <a href="javascript:;" onclick="payment()"
                                            class="btn btn-primary btn-label right ms-auto nexttab"
                                            data-nexttab="pills-payment-tab"><i
                                                class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Lanjutkan
                                            ke Info Pembayaran</a>
                                    </div>
                                </div>
                                <!-- end tab pane -->

                                <div class="tab-pane fade" id="pills-payment" role="tabpanel"
                                    aria-labelledby="pills-payment-tab">
                                    <div id="bukti">
                                        <div>
                                            <h5 class="mb-1">Bukti Pembayaran</h5>
                                            <p class="text-muted mb-4">Silahkan upload bukti pembayaran</p>
                                        </div>

                                        <div class="card p-4 border shadow-none mb-0 mt-4">
                                            <div class="row gy-3">
                                                <div class="col-md-12">
                                                    <label for="image" class="form-label">Bukti Pembayaran</label>
                                                    <input type="file" class="form-control" id="image" name="image">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="description" class="form-label">Keterangan</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button" class="btn btn-light btn-label previestab"
                                            data-previous="pills-bill-address-tab">
                                            <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                            Kembali ke Metode Pembayaran</button>
                                        <a href="javascript:;" onclick="checkout('#form_checkout', 'POST')"
                                            class="btn btn-primary btn-label right ms-auto nexttab"
                                            data-nexttab="pills-finish-tab"><i
                                                class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>
                                            Selesaikan
                                            Pesanan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Ringkasan Pesanan</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th style="width: 90px;" scope="col">Tiket</th>
                                            <th scope="col" class="text-nowrap">Info Tiket</th>
                                            <th scope="col" class="">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $item)
                                            @php
                                                $total = 0;
                                                $total += $item->ticket->price * $item->quantity;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="avatar-md bg-light rounded p-1">
                                                        <img src="{{ asset('images/tickets/' . $item->ticket->cover) }}"
                                                            alt="" class="img-fluid d-block">
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14"><a href="apps-ecommerce-product-details.html"
                                                            class="text-dark">{{ $item->ticket->title }}</a>
                                                    </h5>
                                                    <span class="fw-semibold">Rp.
                                                        {{ number_format($item->ticket->price) . ' x ' . $item->quantity }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <span class="fw-semibold">Rp.
                                                        {{ number_format($item->ticket->price * $item->quantity) }}</span>
                                                </td>
                                            </tr>

                                            <tr class="table-active">
                                                <th colspan="2">Total (IDR) :</th>
                                                <td class="text-end">
                                                    <span class="fw-semibold">Rp. {{ number_format($total) }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </form>
    </div>
    <div id="content_detail"></div>
@section('custom_js')
    <script>
        $(document).ready(function() {
            $('.nexttab').click(function() {
                var nexttab = $(this).data('nexttab');
                $('#' + nexttab).click();
            });

            $('.previestab').click(function() {
                var previestab = $(this).data('previous');
                $('#' + previestab).click();
            });
        });

        function payment() {
            var payment = $('input[name="payment"]:checked').val();
            console.log(payment);
            if (payment == 'Cash') {
                $('#bukti').hide();
            } else {
                $('#bukti').show();
            }
        }

        function checkout(form, method) {
            let formData = new FormData($(form)[0]);
            $.ajax({
                url: "{{ route('web.check') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.alert == 'error') {
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        setTimeout(function() {
                            $(tombol).prop("disabled", false);
                            $(tombol).removeAttr("data-kt-indicator");
                        }, 2000);
                    } else {
                        $('#form_checkout').submit();
                    }
                }
            });
        }
    </script>
@endsection
@endsection
