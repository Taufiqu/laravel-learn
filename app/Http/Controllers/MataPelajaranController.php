<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Http\Requests\StoreMataPelajaranRequest;
use App\Http\Requests\UpdateMataPelajaranRequest;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $query = MataPelajaran::withCount('gurus');

        if (request('search')) {
            $query->where('nama_mata_pelajaran', 'like', '%' . request('search') . '%')
                  ->orWhere('kode_mata_pelajaran', 'like', '%' . request('search') . '%');
        }

        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('jenis')) {
            $query->where('jenis', request('jenis'));
        }

        $mataPelajarans = $query->latest()->paginate(10);

        return view('mata-pelajaran.index', compact('mataPelajarans'));
    }

    public function create()
    {
        return view('mata-pelajaran.create');
    }

    public function store(StoreMataPelajaranRequest $request)
    {
        $data = $request->validated();
        MataPelajaran::create($data);

        return redirect()->route('mata-pelajaran.index')
                        ->with('success','Mata pelajaran berhasil ditambahkan.');
    }

    public function show(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->load('gurus', 'kelas');
        return view('mata-pelajaran.show', compact('mataPelajaran'));
    }

    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('mata-pelajaran.edit', compact('mataPelajaran'));
    }

    public function update(UpdateMataPelajaranRequest $request, MataPelajaran $mataPelajaran)
    {
        $data = $request->validated();
        $mataPelajaran->update($data);

        return redirect()->route('mata-pelajaran.index')
                        ->with('success','Mata pelajaran berhasil diubah.');
    }

    public function destroy(MataPelajaran $mataPelajaran)
    {
        // Cek apakah masih ada guru yang mengajar mata pelajaran ini
        if ($mataPelajaran->gurus()->count() > 0) {
            return redirect()->route('mata-pelajaran.index')
                           ->with('error','Mata pelajaran tidak dapat dihapus karena masih ada guru yang mengajar.');
        }

        // Cek apakah masih ada jadwal kelas untuk mata pelajaran ini
        if ($mataPelajaran->kelas()->count() > 0) {
            return redirect()->route('mata-pelajaran.index')
                           ->with('error','Mata pelajaran tidak dapat dihapus karena masih memiliki jadwal kelas.');
        }

        $mataPelajaran->delete();

        return redirect()->route('mata-pelajaran.index')
                         ->with('success','Data mata pelajaran berhasil dihapus.');
    }

    /**
     * Toggle status mata pelajaran
     */
    public function toggleStatus(MataPelajaran $mataPelajaran)
    {
        $newStatus = $mataPelajaran->status === 'aktif' ? 'nonaktif' : 'aktif';
        
        $mataPelajaran->update([
            'status' => $newStatus
        ]);

        $statusText = $newStatus === 'aktif' ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('mata-pelajaran.index')
                        ->with('success', "Mata pelajaran {$mataPelajaran->nama_mata_pelajaran} berhasil {$statusText}.");
    }
}
