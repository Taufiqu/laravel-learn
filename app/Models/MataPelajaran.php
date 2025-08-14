<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mata_pelajaran',
        'kode_mata_pelajaran',
        'deskripsi',
        'kategori',
        'jam_per_minggu',
        'tingkat',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
        'jam_per_minggu' => 'integer',
    ];

    /**
     * Relasi many-to-many dengan Guru melalui pivot table guru_mata_pelajaran
     */
    public function gurus()
    {
        return $this->belongsToMany(Guru::class, 'guru_mata_pelajaran')
                    ->withTimestamps();
    }

    /**
     * Relasi many-to-many dengan Kelas melalui pivot table kelas_mata_pelajaran
     */
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mata_pelajaran')
                    ->withPivot('guru_id', 'hari', 'jam_mulai', 'jam_selesai')
                    ->withTimestamps();
    }

    /**
     * Scope untuk mata pelajaran yang aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    /**
     * Scope untuk mata pelajaran berdasarkan tingkat
     */
    public function scopeByTingkat($query, $tingkat)
    {
        return $query->where('tingkat', $tingkat)->orWhereNull('tingkat');
    }

    /**
     * Accessor untuk kategori dalam bahasa Indonesia
     */
    public function getKategoriLabelAttribute()
    {
        $kategori = [
            'Wajib' => 'Mata Pelajaran Wajib',
            'Pilihan' => 'Mata Pelajaran Pilihan',
            'Muatan Lokal' => 'Muatan Lokal'
        ];

        return $kategori[$this->kategori] ?? $this->kategori;
    }
}
