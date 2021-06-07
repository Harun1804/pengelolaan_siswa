<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\SiswaRequest;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $siswa = Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        }else{

            $siswa = Siswa::all();
        }
        return view('siswa.index',compact('siswa'));
    }

    public function store(SiswaRequest $request)
    {
        Siswa::create($request->validated());
        return redirect()->route('siswa.index')->with('success','Data Berhasil Masuk');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit',compact('siswa'));
    }

    public function update(Siswa $siswa,SiswaRequest $request)
    {
        $cariSiswa = Siswa::find($siswa->id);
        $cariSiswa->update($request->validated());
        return redirect()->route('siswa.index')->with('success','Data Berhasil Diubah');
    }

    public function delete(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);
        return redirect()->route('siswa.index')->with('success','Data Berhasil Dihapus');
    }
}
