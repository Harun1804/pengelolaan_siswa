@extends('layouts.master')

@section('title','Data Siswa')

@section('content')
@if (session("success"))
<div class="alert alert-success" role="alert">
    {{ session("success") }}
</div>
@endif
<div class="row">
    <div class="col-6">
        <h1>Data Siswa</h1>
    </div>
    <div class="col-6">
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
            data-bs-target="#siswaModal">Tambah Data</button>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>NAMA DEPAN</th>
            <th>NAMA BELAKANG</th>
            <th>JENIS KELAMIN</th>
            <th>AGAMA</th>
            <th>ALAMAT</th>
            <th>AKSI</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswa as $s)
        <tr>
            <td>{{ $s->nama_depan }}</td>
            <td>{{ $s->nama_belakang }}</td>
            <td>{{ $s->jenis_kelamin }}</td>
            <td>{{ $s->agama }}</td>
            <td>{{ $s->alamat }}</td>
            <td>
                <a href="{{ route('siswa.edit',$s->id) }}" class="btn btn-warning text-white d-inline btn-sm">UBAH</a>
                <form method="POST" action="{{ route('siswa.delete',$s->id) }}" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger text-white btn-sm" onclick="return confirm('Yakin ?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection

@section('modal')
<div class="modal fade" id="siswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="siswaModalLabel">Masukan Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('siswa.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_depan" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control @error('nama_depan')
                            is-invalid
                        @enderror" id="nama_depan" name="nama_depan" value="{{ old('nama_depan') }}">
                        @error('nama_depan')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_belakang" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control @error('nama_belakang')
                        is-invalid
                    @enderror" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang') }}">
                        @error('nama_belakang')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('jenis_kelamin')
                            is-invalid
                        @enderror" type="radio" name="jenis_kelamin" id="laki-laki" value="laki-laki">
                            <label class="form-check-label" for="laki-laki">
                                Laki - laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('jenis_kelamin')
                            is-invalid
                        @enderror" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan">
                            <label class="form-check-label" for="perempuan">
                                Perempuan
                            </label>
                        </div>
                        @error('jenis_kelamin')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="agama">Agama</label>
                        <select class="form-select my-3 @error('agama')
                        is-invalid
                    @enderror" name="agama" id="agama">
                            <option selected>Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Budha</option>
                        </select>
                        @error('agama')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat')
                        is-invalid
                    @enderror" id="alamat" rows="3" name="alamat">{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
    @if (session('error'))
        <script>
            let modal = document.getElementById('siswaModal');
            modal.modal({show:true});
        </script>
    @endif
@endsection