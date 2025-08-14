<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    public function index()
    {
        $query = Siswa::with('kelas'); // <-- Muat relasi 'kelas' di awal

        if (request('search')) {
            $query->where('nama', 'like', '%' . request('search') . '%');
        }

        $siswa = $query->latest()->paginate(10);

        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all(); // Ambil semua data kelas
        return view('siswa.create', compact('kelas')); // Kirim ke view
    }

    public function store(StoreSiswaRequest $request)
    {
        $data = $request->validated(); // Ambil data yang sudah divalidasi
        $namaFileFoto = null;

        if ($request->hasFile('foto')) {
            $namaFileFoto = $request->file('foto')->store('foto-siswa', 'public');
        }

        $data['foto'] = $namaFileFoto;
        Siswa::create($data);

        return redirect()->route('siswa.index')
                        ->with('success','Data siswa berhasil ditambahkan.');
    }
        
    public function show(Siswa $siswa)
    {
        //
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all(); // Ambil semua data kelas
        return view('siswa.edit', compact('siswa', 'kelas')); // Kirim ke view
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $data = $request->validated();
        $namaFileFoto = $siswa->foto;
        if ($request->hasFile('foto')) {
            if ($siswa->foto) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $namaFileFoto = $request->file('foto')->store('foto-siswa', 'public');
        }

        $data['foto'] = $namaFileFoto;
        $siswa->update($data);

        return redirect()->route('siswa.index')
                        ->with('success','Data siswa berhasil diubah.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')
                         ->with('success','Data siswa berhasil dihapus.');
    }

    public function trash()
    {
        $siswa = Siswa::onlyTrashed()->paginate(10);
        return view('siswa.trash', compact('siswa'));
    }

    public function restore($id)
    {
        $siswa = Siswa::onlyTrashed()->findOrFail($id);
        $siswa->restore();

        return redirect()->route('siswa.trash')->with('success','Data siswa berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $siswa = Siswa::onlyTrashed()->findOrFail($id);
        $siswa->forceDelete();
        return redirect()->route('siswa.trash')->with('success','Data siswa berhasil dihapus permanen.');
    }
}
