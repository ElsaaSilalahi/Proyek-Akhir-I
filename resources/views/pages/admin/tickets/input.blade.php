<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Buat Tiket</h4>
    </div>
</div>
<form id="form_input">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label for="" class="form-label">Pilih Kategori</label>
                <select name="category_id" class="form-select">
                    <option disabled selected>Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == $data->category_id ? 'selected' : '' }}>{{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control">{{ $data->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Harga</label>
                <input type="number" name="price" class="form-control" placeholder="Masukkan Harga"
                    value="{{ $data->price }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tersedia</label>
                <input type="number" name="stock" class="form-control" placeholder="Masukkan Stok"
                    value="{{ $data->stock }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Gambar</label>
                <input type="file" name="cover" class="form-control" placeholder="Masukkan Gambar"
                    value="{{ $data->cover }}">
            </div>
        </div>
        <div class="card-footer">
            <div class="hstack gap-2 justify-content-end">
                <a class="btn btn-light" href="javascript:;" onclick="back();">Kembali</a>
                @if ($data->id)
                    <button id="tombol_simpan"
                        onclick="handle_upload('#tombol_simpan','#form_input','{{ route('admin.tickets.update', $data->id) }}','PATCH');"
                        class="btn btn-primary" id="add-btn">Perbarui</button>
                @else
                    <button id="tombol_simpan"
                        onclick="handle_upload('#tombol_simpan','#form_input','{{ route('admin.tickets.store') }}','POST');"
                        class="btn btn-primary" id="add-btn">Simpan</button>
                @endif
            </div>
        </div>
    </div>
</form>
