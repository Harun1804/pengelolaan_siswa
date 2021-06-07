@extends('layouts.master')
@section('title','Edit Data Siswa')
@section('content')
<h1>Edit Data Siswa</h1>
<form method="POST" action="{{ route('siswa.update',$siswa->id) }}">
    @method('put')
    @csrf
    <div class="mb-3">
        <label for="nama_depan" class="form-label">Nama Depan</label>
        <input type="text" class="form-control @error('nama_depan')
            is-invalid
        @enderror" id="nama_depan" name="nama_depan" value="{{ old('nama_depan', $siswa->nama_depan) }}">
        @error('nama_depan')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nama_belakang" class="form-label">Nama Belakang</label>
        <input type="text" class="form-control @error('nama_belakang')
        is-invalid
    @enderror" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang',$siswa->nama_belakang) }}">
        @error('nama_belakang')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input 
                    @error('jenis_kelamin') is-invalid @enderror" 
                    type="radio" 
                    name="jenis_kelamin" 
                    id="laki-laki" 
                    value="laki-laki" 
                    @if ($siswa->jenis_kelamin == 'laki-laki') checked @endif>
            <label class="form-check-label" for="laki-laki">
                Laki - laki
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input 
                    @error('jenis_kelamin') is-invalid @enderror" 
                    type="radio" 
                    name="jenis_kelamin" 
                    id="perempuan" 
                    value="perempuan" 
                    @if ($siswa->jenis_kelamin == 'perempuan') checked @endif>
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
            <option value="islam" @if ($siswa->agama == 'islam') selected @endif>Islam</option>
            <option value="kristen" @if ($siswa->agama == 'kristen') selected @endif>Kristen</option>
            <option value="katolik" @if ($siswa->agama == 'katolik') selected @endif>Katolik</option>
            <option value="hindu" @if ($siswa->agama == 'hindu') selected @endif>Hindu</option>
            <option value="budha" @if ($siswa->agama == 'budha') selected @endif>Budha</option>
        </select>
        @error('agama')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control 
        @error('alamat') is-invalid @enderror" 
        id="alamat" 
        rows="3" 
        name="alamat">{{ old('alamat',$siswa->alamat) }}</textarea>
        @error('alamat')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Ubah Data</button>
</form>
@endsection