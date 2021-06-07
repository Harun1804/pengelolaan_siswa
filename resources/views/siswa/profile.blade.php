@extends('layouts.master')
@section('title','Profile Siswa')
@section('content')
<div class="panel panel-profile">
    <div class="clearfix">
        <!-- LEFT COLUMN -->
        <div class="profile-left">
            <!-- PROFILE HEADER -->
            <div class="profile-header">
                <div class="overlay"></div>
                <div class="profile-main">
                    <img src="{{ $siswa->getAvatar() }}" class="img-circle" alt="Avatar" height="100px" width="100px">
                    <h3 class="name">{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</h3>
                    <span class="online-status status-available">Available</span>
                </div>
                <div class="profile-stat">
                    <div class="row">
                        <div class="col-md-4 stat-item">
                            {{ $siswa->mapel->count() }} <span>Mata Pelajaran</span>
                        </div>
                        <div class="col-md-4 stat-item">
                            15 <span>Awards</span>
                        </div>
                        <div class="col-md-4 stat-item">
                            2174 <span>Points</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE HEADER -->
            <!-- PROFILE DETAIL -->
            <div class="profile-detail">
                <div class="profile-info">
                    <h4 class="heading">Data Diri</h4>
                    <ul class="list-unstyled list-justify">
                        <li>Jenis Kelamin <span>{{ $siswa->jenis_kelamin }}</span></li>
                        <li>Agama <span>{{ $siswa->agama }}</span></li>
                        <li>Alamat <span>{{ $siswa->alamat }}</span></li>
                    </ul>
                </div>
                <div class="text-center"><a href="{{ route('siswa.edit',$siswa->id) }}" class="btn btn-warning">Edit Profile</a></div>
            </div>
            <!-- END PROFILE DETAIL -->
        </div>
        <!-- END LEFT COLUMN -->
        <!-- RIGHT COLUMN -->
        <div class="profile-right">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif
            @if (session('danger'))
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-times-circle"></i> {{ session('danger') }}
            </div>
            @endif
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nilaiModal">Tambah Nilai</button>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Mata Pelajaran</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>KODE</th>
                                <th>NAMA MATA PELAJARAN</th>
                                <th>SEMESTER</th>
                                <th>NILAI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa->mapel as $mapel)
                                <tr>
                                    <td>{{ $mapel->kode }}</td>
                                    <td>{{ $mapel->nama_mapel }}</td>
                                    <td>{{ $mapel->semester }}</td>
                                    <td>{{ $mapel->pivot->nilai }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center">Belum Ada Mata Pelajaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END RIGHT COLUMN -->
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="nilaiModal" tabindex="-1" aria-labelledby="nilaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nilaiModalLabel">Tambah Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('siswa.addNilai',$siswa->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="mapel_id">Mata Pelajaran</label>
                        <select class="form-control my-3 @error('mapel_id') is-invalid @enderror" name="mapel_id" id="mapel_id">
                            <option selected>Pilih Mapel</option>
                            @foreach ($matapelajaran as $mp)
                                <option value="{{ $mp->id }}">{{ $mp->nama_mapel }}</option>
                            @endforeach
                        </select>
                        @error('mapel_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <input type="number" class="form-control @error('nilai')
                            is-invalid
                        @enderror" id="nilai" name="nilai" value="{{ old('nilai') }}" autocomplete="off">
                        @error('nilai')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection