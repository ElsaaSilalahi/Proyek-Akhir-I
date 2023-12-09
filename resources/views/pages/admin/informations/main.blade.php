@extends('layouts.master')
@section('title', 'Informasi')
@section('content')
    <div id="content_list">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Informasi</h4>
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
                                        onclick="load_input('{{ route('admin.informations.create') }}');"><i
                                            class="ri-add-line align-bottom me-1"></i> Tambah Informasi</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle" id="datatables" style="width: 100%">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                ajax: '{{ route('admin.informations.index') }}',
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'action',
                        name: 'action'
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
        });
    </script>
@endsection
@endsection
