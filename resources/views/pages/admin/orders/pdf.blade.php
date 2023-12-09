<html>

<head>
    <title>Daftar Transaksi Pemesanan Tiket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;

            /** Extra personal styles **/
            background-color: white;
            color: black;
            text-align: left;
            font-size: 10px;
        }
    </style>
    <center>
        <h3> Museum Tb Silalahi Center<h3>
                <h6> Jl. Dr. TB. Silalahi No.88, Silalahi Pagar Batu, Kec. Balige, Toba, Sumatera Utara 20553<h6>
                        <br />
                        <h5>Laporan Transaksi Pemesanan Tiket {{ $date }}</h5>
    </center>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>Code Pesanan</th>
                <th>Nama Pemesan</th>
                <th>Kategori Tiket</th>
                <th>Total Biaya</th>
                <th>Metode Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Tanggal Pemesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="text-nowrap">{{ $order->user->fullname }}</td>
                    <td>
                        @foreach ($order->orderDetails as $item)
                            - {{ $item->ticket->category->name }}
                            <br>
                        @endforeach
                    </td>
                    <td>Rp. {{ number_format($order->total, 2, ',', '.') }}</td>
                    <td class="text-nowrap">{{ $order->payment->method }}</td>
                    <td class="text-nowrap">
                        @if ($order->payment->status == 'pending')
                            Menunggu
                        @elseif ($order->payment->status == 'approved')
                            @if ($order->payment->method == 'Cash')
                                Dikonfirmasi (Belum Dibayar)
                            @else
                                Dikonfirmasi
                            @endif
                        @elseif ($order->payment->status == 'rejected')
                            Ditolak
                        @endif
                    </td>
                    <td class="text-nowrap">{{ $order->created_at->translatedFormat('l, d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <footer>
        <hr>
        TB Silalahi Center - {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
    </footer>
</body>

</html>
