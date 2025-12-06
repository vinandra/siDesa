@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Akun Penduduk</h1>
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
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
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $resident->name }}</td>
                                            <td>{{ $resident->email }}</td>
                                            <td>
                                                @if ($resident->status == 'approved')
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-danger">tidak aktif</span>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="d-flex" style="gap: 10px;">
                                                    @if ($resident->status == 'approved')
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirmationReject-{{ $resident->id }}">
                                                            Nonaktifkan Akun
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-outline-success ms-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirmationApprove-{{ $resident->id }}">
                                                            Aktifkan Akun
                                                        </button>
                                                    @endif


                                                </div>
                                            </td>
                                        </tr>
                                        @include('pages.account-list.confirmation-approve')
                                        @include('pages.account-list.confirmation-reject')
                                    @endforeach

                                </tbody>
                            @endif

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
