<!-- Modal -->
<div class="modal fade" id="confirmationApprove-{{ $resident->id }}" tabindex="-1"
    aria-labelledby="confirmationApproveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/account-request/approval/{{ $resident->id }}" method="POST">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="confirmationApproveLabel">Konfirmasi Setujui</h4>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="for" value="approve">
                    <span>Apakah ada yakin ingin menyetujui akun ini ?</span>
                    <div class="form-group mt-3">
                        <label for="resident_id">
                            pilih penduduk
                        </label>
                        <select name="resident_id" id="resident_id" class="form-control">
                            <option value="">Tidak ada</option>
                            @foreach ($residents as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ya, setuju!</button>
                </div>
            </div>
        </form>
    </div>
</div>
