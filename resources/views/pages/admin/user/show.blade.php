<div class="card">
    <div class="card-header border-0">
        <div class="row g-4">
            <div class="col-sm">
                <div class="d-flex justify-content-sm-start">
                    <div class="my-2">
                        <h4>Detail Pengguna</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="d-flex justify-content-sm-end">
                    <div class="my-2">
                        <a href="javascript:;" onclick="back();" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
        </div>
        <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" readonly>
        </div>
    </div>
</div>
