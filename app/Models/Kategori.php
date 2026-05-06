<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penerima;

class Kategori extends Model
{
    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori'
    ];

    public function penerimas()
    {
        return $this->hasMany(Penerima::class);
    }
}