<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisBantuan;
use App\Models\Kategori; // TAMBAHKAN

class Penerima extends Model
{
    use HasFactory;

    protected $table = 'penerima';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'alamat',
        'jenis_bantuan_id',
        'kategori_id', // GANTI INI
        'status_penyaluran',
        'foto'
    ];

    public function jenisBantuan()
    {
        return $this->belongsTo(JenisBantuan::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}