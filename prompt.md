# Prompt Pengembangan Sistem Absensi Siswa

Salin prompt di bawah ini saat meminta AI atau developer melanjutkan pengembangan proyek.

---

## Prompt

Anda sedang melanjutkan proyek **Sistem Absensi Siswa SMK Warna Dunia**, sebuah aplikasi web PHP untuk mengelola data siswa dan mencatat absensi. Pahami konteks berikut sebelum mengubah kode. Periksa implementasi yang ada terlebih dahulu, pertahankan alur yang masih digunakan, dan jangan mengasumsikan fitur atau konfigurasi yang belum tersedia.

### Tujuan produk

Bangun dan rawat aplikasi administrasi sekolah yang sederhana, mudah dipakai, dan responsif untuk:

1. Melihat serta mengelola data siswa.
2. Mencatat serta mengelola data absensi siswa.
3. Menampilkan status atau pesan yang jelas jika database belum siap.

Antarmuka menggunakan bahasa Indonesia. Pertahankan tampilan yang clean dan modern: sidebar navigasi, header halaman, latar netral, kartu/formulir yang rapi, tabel yang mudah dibaca, dan layout yang tetap nyaman di layar ponsel.

### Teknologi dan batasan proyek

- PHP prosedural dengan ekstensi MySQLi.
- MySQL atau MariaDB.
- Bootstrap 5 lokal di folder `assets/` dan CSS kustom di `style.css`.
- Tidak ada framework PHP, package manager, atau autentikasi pengguna yang dikonfigurasi saat ini.
- Gunakan pola, versi sintaks, dan struktur yang kompatibel dengan proyek yang ada. Persyaratan dokumentasi saat ini menyebut PHP 7.3+.
- Jangan menambahkan dependensi atau layanan eksternal tanpa kebutuhan yang jelas.

### Halaman dan alur

- `index.php?page=home`: halaman absensi, formulir pencatatan, dan riwayat absensi.
- `index.php?page=data`: daftar siswa dan aksi pengelolaan.
- `index.php?page=tambah`: formulir penambahan siswa.
- `form-edit.php`: formulir edit siswa.
- `form-edit-absensi.php`: formulir edit absensi.
- Skrip `proses-*.php` menerima data formulir dan mengarahkan pengguna kembali ke halaman yang sesuai.
- `hapus.php` dan `hapus-absensi.php` menghapus data berdasarkan NIS.

### Database

Koneksi berada di `koneksi.php`. Konfigurasi lokal bawaan:

- Host: `localhost`
- User: `root`
- Password: kosong
- Database: `absensi`

Skema dan contoh data awal terdapat di `absensi.sql`. Skema saat ini:

- `siswa`: `nis` (primary key, integer auto-increment), `nama`, `alamat`, `jenis_kelamin`, `agama`.
- `absen`: `nis` (primary key, integer), `nama`, `jam_absen`, `tanggal`.

Karena `nis` menjadi primary key pada tabel `absen`, skema sekarang hanya memungkinkan satu baris absensi per NIS. Jangan mengubah model ini atau menambahkan absensi berulang harian tanpa terlebih dahulu menjelaskan dampaknya dan memastikan perubahan skema yang diperlukan.

Jika database atau koneksi tidak tersedia, tampilkan pesan bantuan yang dapat dipahami pengguna. Jangan menyembunyikan kegagalan query atau menampilkan data palsu seolah-olah berhasil. Jangan mengubah konfigurasi lokal menjadi kredensial produksi atau menambahkan kredensial rahasia ke repository.

### Peta file utama

- `index.php`: kerangka aplikasi, navigasi, dan pemilihan halaman.
- `home.php`: konten absensi.
- `data.php`: daftar siswa.
- `form-tambah.php`, `form-edit.php`, `form-edit-absensi.php`: formulir siswa dan absensi.
- `proses-tambah.php`, `proses-edit.php`, `proses-tambah-absensi.php`, `proses-edit-absensi.php`: operasi tulis.
- `hapus.php`, `hapus-absensi.php`: operasi hapus.
- `koneksi.php`: koneksi database.
- `database-error.php`: pesan ketika database belum siap.
- `style.css`: desain responsif.
- `assets/`: Bootstrap lokal.
- `absensi.sql`: skema dan data contoh.
- `README.md`: panduan instalasi dan penggunaan.

### Panduan saat mengerjakan perubahan

1. Periksa file dan alur terkait sebelum mengedit; lakukan perubahan sekecil mungkin yang menyelesaikan kebutuhan.
2. Pertahankan nama parameter formulir, URL navigasi, dan tujuan redirect yang masih digunakan, kecuali perubahan perilaku memang diminta.
3. Jaga konsistensi tampilan untuk halaman utama, daftar, tambah, dan edit; pastikan usable pada desktop dan ponsel.
4. Escape output HTML dari data pengguna. Untuk query yang memakai input, gunakan prepared statement MySQLi dan validasi input yang sesuai tanpa mengubah format penyimpanan yang diperlukan.
5. Tampilkan kegagalan operasi secara jelas; jangan menganggap operasi berhasil hanya karena formulir terkirim.
6. Perbarui `README.md` jika instalasi, fitur, atau konfigurasi berubah.
7. Jalankan pemeriksaan PHP atau tes paling relevan yang tersedia, kemudian laporkan hasil dan keterbatasan yang belum dapat diuji.
8. Jangan menghapus, menimpa, atau mengubah data pengguna yang sudah ada tanpa persetujuan eksplisit. Impor `absensi.sql` ditujukan untuk instalasi baru; file tersebut menyertakan contoh data.
9. Saat pengguna meminta perubahan kode, kerjakan perubahan sampai selesai dan rangkum file yang berubah serta validasi yang dilakukan.

---

## Ringkasan singkat untuk konteks

> Lanjutkan Sistem Absensi Siswa SMK Warna Dunia, aplikasi PHP prosedural + MySQLi + Bootstrap lokal. Aplikasi mengelola siswa dan absensi dengan halaman home/data/tambah serta formulir edit terpisah. Pertahankan desain clean modern dan responsif, bahasa Indonesia, navigasi serta alur CRUD yang ada. Database `absensi` dikonfigurasi di `koneksi.php`, skemanya ada di `absensi.sql`. Periksa kode sebelum mengubahnya, jaga kompatibilitas PHP, validasi input dan escape output, tampilkan error dengan jelas, jangan mengarang data atau mengubah skema tanpa memastikan kebutuhan, perbarui dokumentasi terkait, dan jalankan validasi yang sesuai.
