<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tong Sampah - Data Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-4">
    <h2>Tong Sampah - Data Siswa</h2>
    <a class="btn btn-info" href="{{ route('siswa.index') }}"> Kembali ke Daftar Siswa</a>

    <table class="table table-bordered mt-2">
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th width="280px">Aksi</th>
        </tr>
        @forelse ($siswa as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nis }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->alamat }}</td>
                <td>
                    <form action="{{ route('siswa.forceDelete', $item->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-success" href="{{ route('siswa.restore', $item->id) }}">Pulihkan</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Data ini akan dihapus permanen! Anda yakin?')">Hapus Permanen</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Tong sampah kosong.</td>
            </tr>
        @endforelse
    </table>
    {!! $siswa->links() !!}
</div>
</body>
</html>