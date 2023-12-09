<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row gx-lg-5">
                    <div class="col-xl-12 col-md-8 mx-auto">
                        <center>
                            <img src="{{ asset('images/informations/' . $information->image) }}" alt=""
                                class="img-fluid d-block" />
                        </center>
                    </div>

                    <div class="col-xl-12">
                        <div class="row mt-4">
                            <center>
                                <h5 class="mb-0">{{ $information->title }}</h5>
                            </center>
                        </div>
                        <div class="mt-xl-0 mt-5">
                            <center>
                                <div class="mt-4 text-muted">
                                    <h5 class="fs-14">Deskripsi :</h5>
                                    <p>
                                        {!! nl2br(e($information->description)) !!}
                                    </p>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="hstack gap-2 justify-content-end">
                        <a class="btn btn-light" href="javascript:;" onclick="load_list(1);">Kembali</a>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
