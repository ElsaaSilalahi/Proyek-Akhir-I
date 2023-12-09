@extends('layouts.master')
@section('title', 'Testimoni Museum')
@section('content')
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
                                <h4>Daftar Testimoni Museum</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Testimoni Museum</h5>
                <div data-simplebar style="height: 300px;" class="px-3 mx-n3">
                    @foreach ($reviews as $item)
                        <div class="d-flex mb-4">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fs-14">{{ $item->user->name }}</h5>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                                </h5>
                                <p class="text-muted">{!! nl2br(e($item->comment)) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
