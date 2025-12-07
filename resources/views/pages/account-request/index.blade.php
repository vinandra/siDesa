@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permintaan Akun</h1>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session()->get('success') }}",
                icon: "success",
            });
        </script>
    @endif

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered tabel-hovered" style="min-width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @if (count($users) < 1)
                                <tbody>
                                    <tr>
                                        <td colspan="11">
                                            <p class="pt-3 text-center">Tidak ada data</p>
                                        </td>
                                    </tr>
                                </tbody>
                            @else
                                <tbody>
                                    @foreach ($users as $resident)
                                        <tr>
                                            <td>{{ $loop->iteration + ($users->firstItem() - 1) }}</td>
                                            <td>{{ $resident->name }}</td>
                                            <td>{{ $resident->email }}</td>
                                            <td>{{ $resident->status }}</td>
                                            <td>
                                                <div class="d-flex" style="gap: 10px;">
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmationReject-{{ $resident->id }}">
                                                        Tolak
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-success ms-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmationApprove-{{ $resident->id }}">
                                                        Setuju
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                        @include('pages.account-request.confirmation-approve')
                                        @include('pages.account-request.confirmation-reject')
                                    @endforeach

                                </tbody>
                            @endif

                        </table>
                    </div>
                </div>
                @if ($users->lastPage() > 1)
                    <div class="card-footer">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
