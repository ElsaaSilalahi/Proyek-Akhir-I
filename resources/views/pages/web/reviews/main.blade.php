@extends('layouts.master')
@section('title', 'Testimoni')
@section('content')
    <div id="content_list">
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
                                    <h4>Testimoni Museum</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <center>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </center>
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
                                    <p class="text-muted">
                                        {!! nl2br(e($item->comment)) !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ route('web.reviews.store') }}" class="mt-3" method="POST"
                        id="form_reviews">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label for="exampleFormControlTextarea1" class="form-label">Tinggalkan Testimoni Anda disini
                                </label>
                                <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3" name="comment"
                                    placeholder="Enter comments"></textarea>
                            </div>
                            <div class="col-lg-12 text-end">
                                <a href="javascript:void(0);" onclick="send();" class="btn btn-primary">Kirim Testimoni</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="content_detail"></div>
@section('custom_js')
    <script>
        load_list(1);

        function send() {
            var data = $('textarea[name=comment]').val();
            if (data == '') {
                toastr.error('Testimoni tidak boleh kosong');
            } else {
                $('#form_reviews').submit();
            }
        }
    </script>
@endsection
@endsection
