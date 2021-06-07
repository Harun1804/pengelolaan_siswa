@extends('layouts.master')

@section('title','Data Siswa')

@section('content')
@if (session("success"))
<div class="alert alert-success" role="alert">
    {{ session("success") }}
</div>
@endif

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Data Siswa</h3>
        <div class="right">
            <button type="button" class="btn" data-toggle="modal"
            data-target="#siswaModal"><i class="lnr lnr-plus-circle"></i></button>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NAMA DEPAN</th>
                    <th>NAMA BELAKANG</th>
                    <th>JENIS KELAMIN</th>
                    <th>AGAMA</th>
                    <th>ALAMAT</th>
                    <th colspan="2" style="text-align:center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $s)
                <tr>
                    <td><a href="{{ route('siswa.profile',$s->id) }}">{{ $s->nama_depan }}</a></td>
                    <td>{{ $s->nama_belakang }}</td>
                    <td>{{ $s->jenis_kelamin }}</td>
                    <td>{{ $s->agama }}</td>
                    <td>{{ $s->alamat }}</td>
                    <td>
                        <a href="{{ route('siswa.edit',$s->id) }}" class="btn btn-warning text-white btn-sm float-right">UBAH</a>
                    </td>
                    <td>
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
</div>

@endsection

@section('modal')
<div class="modal fade" id="siswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="siswaModalLabel">Masukan Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('siswa.store') }}" enctype="multipart/form-data">
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email')
                    is-invalid
                @enderror" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <br>
                        <label class="fancy-radio">
                            <input name="jenis_kelamin" value="laki-laki" type="radio" class="d-inline @error('jenis_kelamin') is-invalid @enderror" @if(old('jenis_kelamin') == 'laki-laki') checked @endif>
                            <span><i></i>Laki - Laki</span>
                        </label>
                        <label class="fancy-radio">
                            <input name="jenis_kelamin" value="perempuan" type="radio" class="d-inline @error('jenis_kelamin') is-invalid @enderror" @if(old('jenis_kelamin') == 'perempuan') checked @endif>
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
                            <option value="islam" @if(old('agama') == 'islam') selected @endif>Islam</option>
                            <option value="kristen" @if(old('agama') == 'kristen') selected @endif>Kristen</option>
                            <option value="katolik" @if(old('agama') == 'katolik') selected @endif>Katolik</option>
                            <option value="hindu" @if(old('agama') == 'hindu') selected @endif>Hindu</option>
                            <option value="budha" @if(old('agama') == 'budha') selected @endif>Budha</option>
                        </select>
                        @error('agama')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat">{{ old('alamat') }}</textarea>
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
    @if (session('errors'))
        <script>
            $('#siswaModal').modal({show:true})
        </script>
    @endif
@endsection