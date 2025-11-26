@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Penduduk</h1>
    </div>

    <div class="row">
        <div class="col">
            <form action="/resident/{{ $resident->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nik">NIK</label>
                            <input type="number" inputmode="numeric" name='nik' id="nik"
                                class="form-control @error('nik') is-invalid @enderror"
                                value="{{ old('nik', $resident->nik) }}">
                            @error('nik')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name='name' id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $resident->name) }}">
                            @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender"
                                class="form-control @error('gender') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Laki-laki',
                'value' => 'male',
            ],
            (object) [
                'label' => 'Perempuan',
                'value' => 'female',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('gender', $resident->gender) == $item->value)>{{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_date">tanggal lahir</label>
                            <input type="date" name='birth_date' id="birth_date"
                                class="form-control @error('birth_date') is-invalid @enderror"
                                value="{{ old('birth_date', $resident->birth_date) }}">
                            @error('birth_date')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_place">tempat lahir</label>
                            <input type="text" name='birth_place' id="birth_place"
                                class="form-control @error('birth_place') is-invalid @enderror"
                                value="{{ old('birth_place', $resident->birth_place) }}">
                            @error('birth_place')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="addresss" cols="30" rows="10"
                                class="form-control @error('address') is-invalid @enderror">{{ old('address', $resident->address) }}</textarea>
                            @error('address')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="religion">Agama</label>
                            <input type="text" name='religion' id="religion"
                                class="form-control @error('religion') is-invalid @enderror"
                                value="{{ old('religion', $resident->religion) }}">
                            @error('religion')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="marital_status">Status Perkawinan</label>
                            <select name="marital_status" id="marital_status"
                                class="form-control @error('marital_status') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Belum menikah',
                'value' => 'single',
            ],
            (object) [
                'label' => 'Sudah menikah',
                'value' => 'merried',
            ],
            (object) [
                'label' => 'Cerai',
                'value' => 'divorced',
            ],
            (object) [
                'label' => 'Janda/Duda',
                'value' => 'windowed',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('marital_status', $resident->marital_status) == $item->value)>{{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="occupation">Perkerjaan</label>
                            <input type="text" name='occupation' id="occupation"
                                class="form-control @error('occupation') is-invalid @enderror"
                                value="{{ old('occupation', $resident->occupation) }}">
                        </div>
                        <div class="form-group
                                mb-3">
                            <label for="phone">Telepon</label>
                            <input type="text" inputmode="numeric" name='phone' id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $resident->phone) }}">
                        </div>
                        <div class="form-group
                                mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Aktif',
                'value' => 'active',
            ],
            (object) [
                'label' => 'Pindah',
                'value' => 'moved',
            ],
            (object) [
                'label' => 'Almarhum',
                'value' => 'deceased',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('status', $resident->status) == $item->value)>{{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap: 10px;">
                            <a href="/resident" class="btn btn-outline-secondary">
                                kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
