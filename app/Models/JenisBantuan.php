<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penerima;

class JenisBantuan extends Model
{
    protected $fillable = ['nama_bantuan']; // optional tapi bagus

    // RELASI KE PENERIMA
    public function penerimas()
    {
        return $this->hasMany(Penerima::class);
    }
}
