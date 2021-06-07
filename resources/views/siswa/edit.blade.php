@extends('layouts.master')
@section('title','Edit Data Siswa')
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Data Siswa</h3>
    </div>
    <div class="panel-body">
        <form method="POST" action="{{ route('siswa.update',$siswa->id) }}" enctype="multipart/form-data">
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
                <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" id="nama_belakang" name="nama_belakang"
                    value="{{ old('nama_belakang',$siswa->nama_belakang) }}">
                @error('nama_belakang')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email')
            is-invalid
        @enderror" id="email" name="email" value="{{ old('email',$siswa->user->email) }}">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <br>
                <label class="fancy-radio">
                    <input name="jenis_kelamin" value="laki-laki" type="radio"
                        class="d-inline @error('jenis_kelamin') is-invalid @enderror" @if($siswa->jenis_kelamin ==
                    'laki-laki') checked @endif>
                    <span><i></i>Laki - Laki</span>
                </label>
                <label class="fancy-radio">
                    <input name="jenis_kelamin" value="perempuan" type="radio"
                        class="d-inline @error('jenis_kelamin') is-invalid @enderror" @if($siswa->jenis_kelamin ==
                    'perempuan') checked @endif>
                    <span><i></i>Perempuan</span>
                </label>

                @error('jenis_kelamin')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="agama">Agama</label>
                <select class="form-control my-3 @error('agama') is-invalid @enderror" name="agama" id="agama">
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
                @error('alamat') is-invalid @enderror" id="alamat" rows="3"
                    name="alamat">{{ old('alamat',$siswa->alamat) }}</textarea>
                @error('alamat')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Avatar</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="avatar" accept="image/*">
                </div>
                @error('avatar')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Ubah Data</button>
        </form>
    </div>
</div>
@endsection