<html>

<head>
    <title>Laporan Pembayaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9vh;
        }
    </style>
    @if ($order->payment->method == 'cash')
        <div style="display: flex;">
            <center>
                <img src="{{ asset('logo.png') }}" alt="logo" style="width: 120px; margin-left: -120px;">
                <span style="font-size: 20px; font-weight: bold;">Museum Tb Silalahi Center</span>
                <h6>Jl. Dr. TB. Silalahi No.88, Silalahi Pagar Batu, Kec. Balige, Toba, Sumatera Utara 20553</h6>
            </center>
        </div>
        <center>
            <h3>Laporan Pemesanan Tiket</h3>
        </center>
    @else
        <div style="display: flex;">
            <center>
                <img src="{{ asset('logo.png') }}" alt="logo" style="width: 120px; margin-left: -120px;">
                <span style="font-size: 20px; font-weight: bold;">Museum Tb Silalahi Center</span>
                <h6>Jl. Dr. TB. Silalahi No.88, Silalahi Pagar Batu, Kec. Balige, Toba, Sumatera Utara 20553</h6>
            </center>
        </div>
        <br>
        <center>
            <h4>Laporan Pemesanan Tiket</h4>
        </center>
    @endif
    <div class="p-3 mx-3">
        <table>
            <tr>
                <td>Nama Pemesan</td>
                <td>:</td>
                <td>{{ $order->user->fullname }}</td>
            </tr>
            <tr>
                <td>Tanggal Pemesanan</td>
                <td>:</td>
                <td>{{ $order->created_at->translatedFormat('l, d F Y') }}</td>
            </tr>
        </table>
        <hr class="my-3">
        <div class="card">
            <div class="card-header py-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <td class="border-0 font-weight-600">Detail</td>
                            <td class="text-right border-0 font-weight-600">Harga</td>
                            <td class="text-right border-0 font-weight-600">Total</td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            @foreach ($order->orderDetails as $item)
                                <tr>

                                    <td class="border-0">{{ $item->ticket->category->name }}</td>
                                    <td class="text-right border-0">Rp.
                                        {{ number_format($item->ticket->price, 2, '.', ',') }} x
                                        {{ $item->quantity }}</td>
                                    <td class="text-right border-0">Rp.
                                        {{ number_format($item->ticket->price * $item->quantity, 2, '.', ',') }}
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" class="bg-light-2 text-right"><strong>Total:</strong></td>
                                <td colspan="2" class="bg-light-2 text-right">Rp.
                                    {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>{{ Str::ucfirst($order->payment->method) }}</td>
                </tr>
                <tr>
                    <td style="padding-right: 35px">Status</td>
                    <td>Menunggu</td>
                </tr>
            </tbody>
        </table>
    </div>

    <footer class="mt-4">
        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <img src="data:image/png;base64, {!! $qrcode !!}">
            </div>
            <div class="col-md-8">
                <h5>Thank You</h5>
                <h6>~ Please Do Come Again ~</h6>
            </div>
        </div>
    </footer>
</body>

</html>
