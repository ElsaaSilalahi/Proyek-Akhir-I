@extends('layouts.master')
@section('title', 'Data Pemesanan')
@section('content')
    <div id="content_list">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Data Pemesanan</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm justify-content-sm-start">
                            <div class="btn-group btn-group-md" role="group">
                                <a href="javascript:;"
                                    onclick="handle_open_modal('{{ route('admin.order.export') }}','#modalListResult','#contentListResult');"
                                    class="btn btn-md btn-primary me-2 col-md-2">
                                    <i class="mdi mdi-file-excel"></i>
                                </a>
                                <a href="javascript:;" onclick="accept_all();" class="btn btn-md btn-success me-2 col-md-2">
                                    <i class="mdi mdi-check-all"></i>
                                </a>
                                <a href="javascript:;" onclick="reject_all();" class="btn btn-md btn-danger me-2 col-md-2">
                                    <i class="mdi mdi-close-box-multiple"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-1 mx-1">
                            <table class="table align-middle" id="datatables" style="width: 100%">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>No</th>
                                        <th>Nama Pemesan</th>
                                        <th>Kode Pembelian</th>
                                        <th>Total Harga</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content_detail"></div>
@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.order.index') }}",
                },
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        width: '50px',
                        className: 'select-checkbox'
                    },
                    {
                        data: 'DT_RowIndex',
                        defaultContent: '',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'code',
                        name: 'code',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'total',
                        name: 'total',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'method',
                        name: 'method',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'proof',
                        name: 'proof',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                responsive: true,
                language: {
                    zeroRecords: "Tidak ada data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                }
            });

            $('#checkAll').on('click', function() {
                if ($(this).is(':checked')) {
                    $('.form-check-input').prop('checked', true);
                } else {
                    $('.form-check-input').prop('checked', false);
                }
            });

            $('#datatables').DataTable().on('order.dt search.dt', function() {
                $('#datatables').DataTable().column(1).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });

        function accept_all() {
            var id = [];
            $('input[name="id[]"]:checked').each(function(i) {
                id[i] = $(this).val();
            });
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menyetujui semua pemesanan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, setuju!'
            }).then((result) => {
                if (result.value) {
                    if (id.length > 0) {
                        $.ajax({
                            url: "{{ route('admin.order.acceptAll') }}",
                            type: "PATCH",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                if (response.alert == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: response.message,
                                    }).then((result) => {
                                        $('#datatables').DataTable().ajax.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response.message,
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Tidak ada data yang dipilih!',
                        });
                    }
                }
            });
        }

        function reject_all() {
            var id = [];
            $('input[name="id[]"]:checked').each(function(i) {
                id[i] = $(this).val();
            });
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang sudah di tolak!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tolak!'
            }).then((result) => {
                if (result.value) {
                    if (id.length > 0) {
                        $.ajax({
                            url: "{{ route('admin.order.rejectAll') }}",
                            type: "PATCH",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                if (response.alert == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: response.message,
                                    }).then((result) => {
                                        $('#datatables').DataTable().ajax.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response.message,
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Tidak ada data yang dipilih!',
                        });
                    }
                }
            })
        }
    </script>
@endsection
@endsection
