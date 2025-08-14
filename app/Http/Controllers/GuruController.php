<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $query = Guru::with('mataPelajarans');

        if (request('search')) {
            $query->where('nama', 'like', '%' . request('search') . '%')
                  ->orWhere('nip', 'like', '%' . request('search') . '%')
                  ->orWhere('mata_pelajaran', 'like', '%' . request('search') . '%');
        }

        if (request('status')) {
            $query->where('status_kepegawaian', request('status'));
        }

        $guru = $query->latest()->paginate(10);

        return view('guru.index', compact('guru'));
    }

    public function create()
    {
        $mataPelajarans = MataPelajaran::aktif()->get();
        return view('guru.create', compact('mataPelajarans'));
    }

    public function store(StoreGuruRequest $request)
    {
        $data = $request->validated();
        $namaFileFoto = null;

        if ($request->hasFile('foto')) {
            $namaFileFoto = $request->file('foto')->store('foto-guru', 'public');
        }

        $data['foto'] = $namaFileFoto;
        $guru = Guru::create($data);

        // Attach mata pelajaran yang dipilih
        if ($request->has('mata_pelajaran_ids')) {
            $guru->mataPelajarans()->attach($request->mata_pelajaran_ids);
        }

        return redirect()->route('guru.index')
                        ->with('success','Data guru berhasil ditambahkan.');
    }

    public function show(Guru $guru)
    {
        $guru->load(['mataPelajarans', 'kelasWaliKelas', 'kelasYangDiajar']);
        return view('guru.show', compact('guru'));
    }

    public function edit(Guru $guru)
    {
        $mataPelajarans = MataPelajaran::aktif()->get();
        $guru->load('mataPelajarans');
        return view('guru.edit', compact('guru', 'mataPelajarans'));
    }

    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        $data = $request->validated();
        $namaFileFoto = $guru->foto;

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $namaFileFoto = $request->file('foto')->store('foto-guru', 'public');
        }

        $data['foto'] = $namaFileFoto;
        $guru->update($data);

        // Sync mata pelajaran yang dipilih
        if ($request->has('mata_pelajaran_ids')) {
            $guru->mataPelajarans()->sync($request->mata_pelajaran_ids);
        } else {
            $guru->mataPelajarans()->detach();
        }

        return redirect()->route('guru.index')
                        ->with('success','Data guru berhasil diubah.');
    }

    public function destroy(Guru $guru)
    {
        // Cek apakah guru masih menjadi wali kelas
        if ($guru->kelasWaliKelas) {
            return redirect()->route('guru.index')
                           ->with('error','Guru tidak dapat dihapus karena masih menjadi wali kelas.');
        }

        // Cek apakah guru masih mengajar
        if ($guru->kelasYangDiajar()->count() > 0) {
            return redirect()->route('guru.index')
                           ->with('error','Guru tidak dapat dihapus karena masih memiliki jadwal mengajar.');
        }

        // Hapus foto jika ada
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        // Detach mata pelajaran
        $guru->mataPelajarans()->detach();
        
        $guru->delete();

        return redirect()->route('guru.index')
                         ->with('success','Data guru berhasil dihapus.');
    }
}
