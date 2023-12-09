<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Detail Pemesanan</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Detail Pemesanan</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-9 mx-auto">
        <div class=" card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Pesanan {{ $order->code }}</h5>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table align-middle table-borderless mb-0 text-center">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width:50px;">Detail Tiket</th>
                                <th scope="col">Harga Tiket</th>
                                <th scope="col" class="text-center">Jumlah</th>
                                <th scope="col" class="">Jumlah Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $item)
                                <tr>
                                    <td class="col-md-4">
                                        <div class="row justify-content-center">
                                            <div class=" flex-shrink-0 avatar-md bg-light rounded p-1 col-md-4"
                                                style="width:60%;height:60%;">
                                                <img src="{{ asset('images/tickets/' . $item->ticket->cover) }}"
                                                    alt="" class="img-fluid d-block" style="height:100%; width:100%; ">
                                                <div class="flex-grow-1 text-wrap text-center mt-1 ">
                                                    <h5 class="col fs-15 link-primary fs-6 text-center">
                                                        {{ $item->ticket->category->name }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp. {{ number_format($item->ticket->price) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="fw-medium">
                                        Rp. {{ number_format($item->quantity * $item->ticket->price) }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="border-top border-top-dashed">
                                <td colspan="2"></td>
                                <td colspan="2" class="fw-medium p-0">
                                    <table class="table table-borderless mb-0 text-nowrap">
                                        <tbody>
                                            <tr class="border-top border-top-dashed">
                                                <th scope="row">Total</th>
                                                <th scope="row">Rp. {{ number_format($order->total) }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="hstack gap-2 justify-content-start">
                    <a class="btn btn-light" href="javascript:;" onclick="load_list(1);">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h5 class="card-title flex-grow-1 mb-0">Detail Pemesan</h5>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);"
                            onclick="load_detail('{{ route('admin.users.show', $order->user->id) }}');"
                            class="link-secondary">Lihat profil</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 vstack gap-3">
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">

                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-14 mb-1">{{ $order->user->name }}</h6>
                                <p class="text-muted mb-0">Pemesan</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>
                        {{ $order->user->email }}
                    </li>
                    <li>
                        <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>
                        {{ $order->user->phone }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
