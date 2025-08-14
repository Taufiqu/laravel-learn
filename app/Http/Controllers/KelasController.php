<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;

class KelasController extends Controller
{
    public function index()
    {
        $query = Kelas::withCount('siswas'); // Count jumlah siswa per kelas

        if (request('search')) {
            $query->where('nama_kelas', 'like', '%' . request('search') . '%')
                  ->orWhere('nama_walikelas', 'like', '%' . request('search') . '%');
        }

        $kelas = $query->latest()->paginate(10);

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(StoreKelasRequest $request)
    {
        $data = $request->validated();
        Kelas::create($data);

        return redirect()->route('kelas.index')
                        ->with('success','Data kelas berhasil ditambahkan.');
    }

    public function show(Kelas $kelas)
    {
        $kelas->load('siswas'); // Load siswa dalam kelas tersebut
        return view('kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        $data = $request->validated();
        $kelas->update($data);

        return redirect()->route('kelas.index')
                        ->with('success','Data kelas berhasil diubah.');
    }

    public function destroy(Kelas $kelas)
    {
        // Cek apakah kelas masih memiliki siswa
        if ($kelas->siswas()->count() > 0) {
            return redirect()->route('kelas.index')
                           ->with('error','Kelas tidak dapat dihapus karena masih memiliki siswa.');
        }

        $kelas->delete();

        return redirect()->route('kelas.index')
                         ->with('success','Data kelas berhasil dihapus.');
    }
}
