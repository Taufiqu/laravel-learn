<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >

</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h2>Edit data</h2>
                <a class="btn btn-success" href="{{ route('siswa.create') }}"> Tambah Siswa Baru</a>
            </div>
        </div>
        <form action="{{ route('siswa.update',$siswa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <div class="form-group">
                <label for="nis">NIS:</label>
                <input type="text" name="nis" id="nis_input" value="{{ $siswa->nis }}" class="form-control" placeholder="Nomor Induk Siswa">
                <small id="nis_alert" class="form-text text-danger" style="display: none;">
                    NIS harus berupa angka!
                </small>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" value="{{ $siswa->nama }}" class="form-control" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" style="height:150px" name="alamat" placeholder="Alamat">{{ $siswa->alamat }}</textarea>
            </div>
            <div class="form-group">
                <label for="kelas_id">Kelas:</label>
                <select name="kelas_id" class="form-control">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item->id }}" {{ $siswa->kelas_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if($siswa->foto)
                <div class="mb-2">
                    <p>Foto Saat Ini:</p>
                    <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Profil" width="100">
                </div>
            @endif
            <div class="form-group">
                <label for="foto">Ganti Foto Profil:</label>
                <input type="file" name="foto" id="input_foto" class="form-control">
                <small id="alert_foto" class="form-text text-danger" style="display: none;"></small>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a class="btn btn-secondary" href="{{ route('siswa.index') }}"> Kembali</a>
        </form>
    </div>

    <script>
    // Ambil elemen input dan elemen alert berdasarkan ID
    const nisInput = document.getElementById('nis_input');
    const nisAlert = document.getElementById('nis_alert');

    // Tambahkan 'event listener' yang akan berjalan setiap kali pengguna mengetik
    nisInput.addEventListener('input', function() {
        // Ambil nilai yang sedang diketik oleh pengguna
        const nilaiInput = this.value;

        // Gunakan regular expression untuk mengecek apakah nilai HANYA berisi angka
        // /^\d*$/ berarti: dari awal (^) sampai akhir ($) harus berisi nol atau lebih digit (\d*)
        if (/^\d*$/.test(nilaiInput)) {
            // Jika valid (hanya angka), sembunyikan pesan error
            nisAlert.style.display = 'none';
        } else {
            // Jika tidak valid (ada karakter selain angka), tampilkan pesan error
            nisAlert.style.display = 'block';
        }
    });
</script>

<script>
    // Ambil elemen yang dibutuhkan
    const inputFoto = document.getElementById('input_foto');
    const alertFoto = document.getElementById('alert_foto');

    // Tambahkan event listener yang berjalan saat pengguna memilih file
    inputFoto.addEventListener('change', function() {
        // Cek apakah ada file yang dipilih
        if (this.files.length > 0) {
            const file = this.files[0];
            const ukuranFile = file.size; // Ukuran dalam bytes
            const ukuranMaksimal = 2 * 1024 * 1024; // 2MB dalam bytes

            if (ukuranFile > ukuranMaksimal) {
                // Jika file terlalu besar
                alertFoto.textContent = 'Ukuran file tidak boleh lebih dari 2MB!';
                alertFoto.style.display = 'block'; // Tampilkan alert
                this.value = ''; // Hapus file yang dipilih agar tidak bisa di-submit
            } else {
                // Jika ukuran file sesuai
                alertFoto.style.display = 'none'; // Sembunyikan alert
            }
        }
    });
</script>

</body>
</html>



