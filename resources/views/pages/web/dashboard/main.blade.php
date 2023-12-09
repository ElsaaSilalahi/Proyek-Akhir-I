@extends('layouts.master')
@section('title', 'Beranda')
@section('content')
    <div id="content_list">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header border-0" style="text-align: justify">
                    <h2>Selamat Datang Museum TB Silalahi Center</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-start">
                                <div class="my-2">
                                    <h4>Daftar Tiket</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">

                        </div>
                    </div>
                    <hr>
                </div>
                <div class="container">
                    <div class="row">
                        @foreach ($tickets as $item)
                            <div class="col-sm-6 col-xl-3">
                                <!-- Simple card -->
                                <div class="card">
                                    <img class="card-img-top img-fluid"
                                        src="{{ asset('images/tickets/' . $item->cover) }}" style="height: 150px;"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h5 style="font-size: 1rem">
                                            {{ $item->category->name }}
                                        </h5>
                                        <small class="text-muted">
                                            Tersedia : {{ $item->stock }}
                                        </small>
                                        <hr>
                                        <h5 style="font-size: 1rem">
                                            {{ number_format($item->price, 2, ',', '.') }}
                                        </h5>
                                        <div class="text-end">
                                            <a href="javascript:;"
                                                onclick="load_detail('{{ route('web.dashboard.show', $item->id) }}')"
                                                class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content_detail"></div>
@section('custom_js')
    <script>
        load_list(1);
    </script>
@endsection
@endsection
