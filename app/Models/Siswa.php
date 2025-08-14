<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nis',
        'nama',
        'alamat',
        'kelas_id', // <-- Tambahkan ini
        'foto',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
