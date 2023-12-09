@extends('layouts.master')
@section('title', 'Tiket')
@section('content')
    <div id="content_list">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Tambah Tiket</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button class="btn btn-primary add-btn" href="javascript:;"
                                        onclick="load_input('{{ route('admin.tickets.create') }}');"><i
                                            class="ri-add-line align-bottom me-1"></i> Tambah Tiket</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle" id="datatables">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th class="sort" data-sort="category">Kategori</th>
                                        <th class="sort" data-sort="price">Harga</th>
                                        <th class="sort" data-sort="stock">Tersedia</th>
                                        <th class="sort" data-sort="action">Aksi</th>
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
    <div id="content_input"></div>
    <div id="content_detail"></div>
@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                serverSide: true,
                ajax: '{{ route('admin.tickets.index') }}',
                columns: [{
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                order: [
                    0, 'asc'
                ],
                responsive: true,
                language: {
                    zeroRecords: "Tidak ada data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                }
            });
        });
    </script>
@endsection
@endsection
