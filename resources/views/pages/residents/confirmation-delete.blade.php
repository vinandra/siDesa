<!-- Modal -->
<div class="modal fade" id="confirmationOnDelete-{{ $resident->id }}" tabindex="-1"
    aria-labelledby="confirmationOnDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/resident/{{ $resident->id }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="confirmationOnDeleteLabel">Konfirmasi Hapus</h4>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Apakah ada yakin ingin menghapus data ini ?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-outline-danger">Ya, hapus!</button>
                </div>
            </div>
        </form>
    </div>
</div>
