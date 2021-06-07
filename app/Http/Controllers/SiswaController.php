<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\SiswaRequest;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $user = new User();
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = Hash::make('rahasia');
        $user->remember_token = Str::random(60);
        $user->role = 'siswa';
        $user->save();

        $request->request->add(['user_id'=>$user->id]);

        $siswa = Siswa::create($request->all());
        if($request->hasFile('avatar')){
            $randomName = Str::random(10);
            $avatar = $request->file('avatar');
            $fileName = $randomName.'.'.$avatar->getClientOriginalExtension();
            $avatar->move('assets/profile/',$fileName);
            $siswa->avatar = $fileName;
            $siswa->save();
        }
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
        if($request->hasFile('avatar')){
            $randomName = Str::random(10);
            $avatar = $request->file('avatar');
            $fileName = $randomName.'.'.$avatar->getClientOriginalExtension();
            $avatar->move('assets/profile/',$fileName);
            $cariSiswa->avatar = $fileName;
            $cariSiswa->save();
        }

        return redirect()->route('siswa.index')->with('success','Data Berhasil Diubah');
    }

    public function delete(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);
        return redirect()->route('siswa.index')->with('success','Data Berhasil Dihapus');
    }

    public function profile(Siswa $siswa)
    {
        $matapelajaran = Mapel::all();
        return view('siswa.profile',compact(['siswa','matapelajaran']));
    }

    public function addNilai(Request $request,$id)
    {
        $siswa = Siswa::find($id);
        if($siswa->mapel()->where('mapel_id',$request->mapel_id)->exists()){
            return redirect()->route('siswa.profile',$id)->with('danger','Mata Pelajaran Sudah Ada');
        }
        $siswa->mapel()->attach($request->mapel_id,['nilai'=>$request->nilai]);
        return redirect()->route('siswa.profile',$id)->with('success','Data nilai berhasil dimasukan');
    }
}
