<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'jenis_kelamin',
        'alamat',
        'telepon',
        'email',
        'status_kepegawaian',
        'mata_pelajaran',
        'tanggal_lahir',
        'tempat_lahir',
        'pendidikan_terakhir',
        'foto',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi ke model Kelas (sebagai wali kelas)
     * Satu guru bisa menjadi wali kelas dari satu kelas
     */
    public function kelasWaliKelas()
    {
        return $this->hasOne(Kelas::class, 'guru_id');
    }

    /**
     * Relasi many-to-many dengan MataPelajaran
     */
    public function mataPelajarans()
    {
        return $this->belongsToMany(MataPelajaran::class, 'guru_mata_pelajaran')
                    ->withTimestamps();
    }

    /**
     * Relasi many-to-many dengan Kelas melalui jadwal mengajar
     */
    public function kelasYangDiajar()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mata_pelajaran')
                    ->withPivot('mata_pelajaran_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruang_kelas')
                    ->withTimestamps();
    }

    /**
     * Accessor untuk mendapatkan nama lengkap dengan gelar
     */
    public function getNamaLengkapAttribute()
    {
        return $this->nama;
    }

    /**
     * Accessor untuk status kepegawaian dalam bahasa Indonesia
     */
    public function getStatusKepegawaianLabelAttribute()
    {
        $status = [
            'PNS' => 'Pegawai Negeri Sipil',
            'GTT' => 'Guru Tidak Tetap',
            'GTY' => 'Guru Tetap Yayasan',
            'Honorer' => 'Guru Honorer'
        ];

        return $status[$this->status_kepegawaian] ?? $this->status_kepegawaian;
    }
}
