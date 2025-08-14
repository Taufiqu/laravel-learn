<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'nama_walikelas',
    ];

    // app/Models/Kelas.php
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
