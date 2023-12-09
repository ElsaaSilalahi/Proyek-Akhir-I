<div class="modal-header bg-light p-3">
    <h5 class="modal-title">
        <i class="ri-file-list-3-line"></i>
        Cetak Data
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
</div>
<div class="modal-body">
    <div class="form-group">
        <form action="{{ route('admin.order.pdf') }}" method="GET">
            <div class="form-group mb-3">
                <label for="">Pilih Bulan</label>
                <select name="date" id="date" class="form-control">
                    <option value="" disabled selected>Pilih Bulan</option>
                    @for ($i = 0; $i < count($dates); $i++)
                        <option value="{{ $dates[$i] }}">{{ $dates[$i] }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Cetak</button>
            </div>
        </form>
    </div>
</div>
