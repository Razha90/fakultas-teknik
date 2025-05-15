@section('title', 'Konten | Fakultas Teknik')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Konten</h4>
        <a href="{{ route('content.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambahkan Data
        </a>
    </div>

    @if ($contents->hasPages())
<nav aria-label="Pagination">
    <ul class="pagination justify-content-center mt-3">
        {{-- Tombol Previous --}}
        @if ($contents->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
            <li class="page-item">
                <button wire:click="previousPage" class="page-link">Previous</button>
            </li>
        @endif

        {{-- Halaman --}}
        @foreach ($contents->getUrlRange(1, $contents->lastPage()) as $page => $url)
            @if ($page == $contents->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $page }}</span>
                </li>
            @else
                <li class="page-item">
                    <button wire:click="gotoPage({{ $page }})" class="page-link">{{ $page }}</button>
                </li>
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($contents->hasMorePages())
            <li class="page-item">
                <button wire:click="nextPage" class="page-link">Next</button>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif
    </ul>
</nav>
@endif

    <table class="table table-bordered table-hover" id="contentTable">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Jenis Konten</th>
                <th>Users</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tanggal Publish</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contents as $content)
                <tr wire:key="content-{{ $content->id }}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $content->title }}</td>
                    <td>{{ $content->type?->name ?? '-' }}</td>
                    <td>{{ $content->user?->fullname ?? '-' }}</td>
                    <td>
                        @foreach ($content->categories as $category)
                            <span class="badge bg-info text-dark">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if ($content->status === 'published')
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                    <td>
                        @if ($content->image)
                            <img src="{{ asset('storage/' . $content->image) }}" alt="image" width="60">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($content->published_at)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('content.edit', $content->id) }}" class="btn btn-sm btn-warning">

                            Edit
                        </a>
                        <button type="button" wire:click="confirmDelete('{{ $content->id }}')" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>

    </table>





    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus konten ini? Tindakan ini tidak bisa dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button wire:click.prevent="deleteConfirmed" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
{{--
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button wire:click="deleteConfirmed" class="btn btn-danger">Hapus</button>
            </div>
          </div>
        </div>
      </div> --}}


    <!-- Modal Konfirmasi Hapus Bootstrap -->


    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif


</div>

<script>

document.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            let alert = document.querySelector('.alert');
            if (alert) alert.remove();
        }, 3000);
    });


    document.addEventListener('livewire:load', function () {
        $('#contentTable').DataTable({
            "paging": false,
            "searching": true,
            "ordering": true,
            "lengthChange": false,
            "pageLength": 10
        });
    });

    window.addEventListener('openDeleteModal', event => {
    var modalEl = document.getElementById('deleteModal');
    var modal = bootstrap.Modal.getInstance(modalEl);

    if (!modal) {
        modal = new bootstrap.Modal(modalEl);
    }

    modal.show();
});

    window.addEventListener('closeDeleteModal', event => {
        var modalEl = document.getElementById('deleteModal');
        var modal = bootstrap.Modal.getInstance(modalEl);

        if (!modal) {
            modal = new bootstrap.Modal(modalEl);
        }

        modal.hide();

        // Hapus backdrop manual setelah animasi selesai (300ms default Bootstrap)
        setTimeout(() => {
            let backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
        }, 400); // tambahkan sedikit jeda agar Bootstrap punya waktu menutup
    });

    window.addEventListener('contentDeleted', event => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Konten berhasil dihapus!',
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
