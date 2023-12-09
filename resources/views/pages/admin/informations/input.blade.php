<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Buat Informasi</h4>
    </div>
</div>
<form id="form_input">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label for="" class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan Judul"
                    value="{{ $data->title }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control"
                    placeholder="Masukkan Deskripsi">{{ $data->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Gambar</label>
                <input type="file" name="image" class="form-control" placeholder="Masukkan Gambar"
                    value="{{ $data->image }}">
            </div>
        </div>
        <div class="card-footer">
            <div class="hstack gap-2 justify-content-end">
                <a class="btn btn-light" href="javascript:;" onclick="back();">Kembali</a>
                @if ($data->id)
                    <button id="tombol_simpan"
                        onclick="handle_upload('#tombol_simpan','#form_input','{{ route('admin.informations.update', $data->id) }}','PATCH');"
                        class="btn btn-primary" id="add-btn">Perbarui</button>
                @else
                    <button id="tombol_simpan"
                        onclick="handle_upload('#tombol_simpan','#form_input','{{ route('admin.informations.store') }}','POST');"
                        class="btn btn-primary" id="add-btn">Simpan</button>
                @endif
            </div>
        </div>
    </div>
</form>
