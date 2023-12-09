@extends('layouts.master')
@section('title', 'Pengguna')
@section('content')
    <div id="content_list">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Pengguna</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                            </div>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle" id="datatables" style="width: 100%">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th class="sort" data-sort="category">Nama</th>
                                        <th class="sort" data-sort="price">Email</th>
                                        <th class="sort" data-sort="stock">Nomor Telepon</th>
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
                ajax: '{{ route('admin.users.index') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
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
