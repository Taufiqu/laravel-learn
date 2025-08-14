<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h2>Manajemen Data Siswa</h2>
            <a class="btn btn-success" href="{{ route('siswa.create') }}"> Tambah Siswa Baru</a>
            <a class="btn btn-secondary ml-2" href="{{ route('siswa.trash') }}">Tong Sampah</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <form action="{{ route('siswa.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama siswa..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered mt-2">
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kelas</th> 
            <th width="280px">Aksi</th>
        </tr>
        @forelse ($siswa as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nis }}</td>
                <td>
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" width="80">
                    @else
                        <span>Tidak Ada Foto</span>
                    @endif
                </td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->kelas->nama_kelas ?? 'Belum ada kelas' }}
                <td>
                    <form action="{{ route('siswa.destroy', $item->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('siswa.edit', $item->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Data Siswa belum Tersedia.</td>
            </tr>
        @endforelse
    </table>

    {!! $siswa->appends(request()->query())->links() !!}

</div>
</body>
</html>