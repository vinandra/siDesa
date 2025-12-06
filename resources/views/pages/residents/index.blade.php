@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halaman Resident</h1>
        <a href="/resident/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-responsive table-bordered tabel-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Agama</th>
                                <th>Status Perkawinan</th>
                                <th>Pekerjaan</th>
                                <th>telephone</th>
                                <th>Status penduduk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @if (count($residents) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="11">
                                        <p class="pt-3 text-center">Tidak ada data</p>
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($residents as $resident)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $resident->nik }}</td>
                                        <td>{{ $resident->name }}</td>
                                        <td>{{ $resident->gender }}</td>
                                        <td>{{ $resident->birth_place }}, {{ $resident->birth_date }}</td>
                                        <td>{{ $resident->address }}</td>
                                        <td>{{ $resident->religion }}</td>
                                        <td>{{ $resident->marital_status }}</td>
                                        <td>{{ $resident->occupation }}</td>
                                        <td>{{ $resident->phone }}</td>
                                        <td>{{ $resident->status }}</td>
                                        <td>
                                            <div class="d-flex gap-2 align-item-center" style="gap: 10px;">
                                                <a href="/resident/{{ $resident->id }}"
                                                    class="d-inline-block btn btn-sm btn-warning">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirmationOnDelete-{{ $resident->id }}">
                                                    <i class="fas fa-eraser"></i>
                                                </button>
                                                @if (!is_null($resident->user_id))
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailAccount-{{ $resident->id }}">
                                                        lihat Akun
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @include('pages.residents.confirmation-delete')
                                    @include('pages.residents.detail-account')
                                @endforeach

                            </tbody>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
