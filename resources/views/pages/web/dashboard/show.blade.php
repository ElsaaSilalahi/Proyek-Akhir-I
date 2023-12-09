<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row gx-lg-5">
                    <div class="col-xl-4 col-md-8 mx-auto">
                        <div class="product-img-slider sticky-side-div">
                            <div
                                class="swiper product-thumbnail-slider p-2 rounded bg-light swiper-initialized swiper-horizontal swiper-pointer-events">
                                <div class="swiper-wrapper" id="swiper-wrapper-3d89eb772a51055d" aria-live="polite"
                                    style="transform: translate3d(0px, 0px, 0px);">
                                    <div class="swiper-slide swiper-slide-active mx-auto" role="group" aria-label="1 / 4"
                                        style="width: 218px; ">
                                        <img src="{{ asset('images/tickets/' . $ticket->cover) }}" alt=""
                                            class="img-fluid d-block" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="mt-xl-0 mt-5">
                            <div class="row mt-4">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="p-2 border border-dashed rounded">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <div class="avatar-title rounded bg-transparent text-info fs-24">
                                                    <i class="ri-money-dollar-circle-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-1">Harga :</p>
                                                <h5 class="mb-0">Rp.
                                                    {{ number_format($ticket->price, 2, ',', '.') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="p-2 border border-dashed rounded">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <div class="avatar-title rounded bg-transparent text-info fs-24">
                                                    <i class="fas fa-ticket-alt"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-1">Tersedia :</p>
                                                <h5 class="mb-0">{{ $ticket->stock }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                            <form id="form_cart">
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <div class="row mt-4">
                                    <div class="col-lg-6 col-sm-8">
                                        <div class="input-step">
                                            <button type="button" onclick="kurang()" class="minus">–</button>
                                            @if ($ticket->category->id == 1 || $ticket->category->id == 2 || $ticket->category->id == 6)
                                                <input type="text" name="quantity" id="qty" value="1" class="input-number"
                                                    min="1" max="{{ $ticket->stock }}">
                                            @elseif ($ticket->category->id == 3 || $ticket->category->id == 4)
                                                <input type="text" name="quantity" id="qty" value="30"
                                                    class="input-number" min="30" max="{{ $ticket->stock }}">
                                            @elseif ($ticket->category->id == 5)
                                                <input type="text" name="quantity" id="qty" value="15"
                                                    class="input-number" min="15" max="{{ $ticket->stock }}">
                                            @endif
                                            <button type="button" onclick="tambah()" class="plus">+</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-4">
                                        <button id="tombol_cart"
                                            onclick="add_cart('#tombol_cart', '#form_cart', '{{ route('web.cart.add') }}', 'POST')"
                                            class="btn btn-primary waves-effect waves-light">Tambah Ke
                                            Pesanan</button>
                                    </div>
                                </div>
                            </form>
                        @endauth
                    </div>
                    <div class="mt-4 text-muted">
                        <h5 class="fs-14">Deskripsi :</h5>
                        <p>{!! nl2br(e($ticket->description)) !!}</p>
                    </div>
                </div>
                <div class="hstack gap-2 justify-content-end">
                    <a class="btn btn-light" href="javascript:;" onclick="load_list(1);">Kembali</a>
                </div>
            </div>

        </div>
    </div>
    <!-- end col -->
</div>
<script>
    function tambah() {
        var value = parseInt($('#qty').val());
        $('#qty').val(value + 1);
    }

    function kurang() {
        var value = parseInt($('#qty').val());
        if (value > $('#qty').attr('min')) {
            $('#qty').val(value - 1);
        } else {
            toastr.error('Stok tidak boleh kurang dari ' + $('#qty').attr('min'));
        }
    }
</script>
