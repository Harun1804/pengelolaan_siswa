<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'siswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar'];

    public function getAvatar()
    {
        if(!$this->avatar){
            return asset('assets/profile/default.png');
        }
        return asset('assets/profile/'.$this->avatar);
    }
}
