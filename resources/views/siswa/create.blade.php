<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Siswa Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Terdapat beberapa masalah dengan inputan Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nis">NIS:</label>
            <input type="text" name="nis" id="nis_input" class="form-control" placeholder="Nomor Induk Siswa">
            <small id="nis_alert" class="form-text text-danger" style="display: none;">
                NIS harus berupa angka!
            </small>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" style="height:150px" name="alamat" placeholder="Alamat"></textarea>
        </div>
        <div class="form-group">
            <label for="kelas_id">Kelas:</label>
            <select name="kelas_id" class="form-control">
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="foto">Foto Profil:</label>
            <input type="file" name="foto" id="input_foto" class="form-control">
            <small id="alert_foto" class="form-text text-danger" style="display: none;"></small>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
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