# Sistem Absensi Siswa

Aplikasi web sederhana untuk mengelola data siswa dan mencatat absensi SMK Warna Dunia. Antarmuka menggunakan Bootstrap dan CSS khusus, dengan halaman yang responsif untuk desktop maupun perangkat seluler.

## Fitur

- Melihat, menambah, mengubah, dan menghapus data siswa.
- Mencatat, melihat, mengubah, dan menghapus absensi siswa.
- Menampilkan pesan panduan jika database belum tersedia.

## Teknologi

- PHP dengan ekstensi MySQLi
- MySQL atau MariaDB
- Bootstrap 5 (disertakan di `assets/`)

## Persyaratan

- PHP 7.3 atau lebih baru dengan ekstensi `mysqli`
- MySQL atau MariaDB
- Web server lokal seperti Laragon, XAMPP, atau PHP built-in server

## Instalasi

1. Clone repository ke folder web server lokal:

   ```bash
   git clone https://github.com/Salmanyuris/Sistem-absensi-siswa.git
   cd Sistem-absensi-siswa
   ```

2. Jalankan MySQL/MariaDB.

3. Buat database dan tabel dengan mengimpor [`absensi.sql`](./absensi.sql) melalui phpMyAdmin atau MySQL client. File tersebut membuat database `absensi`, tabel `siswa` dan `absen`, serta menyertakan beberapa contoh data. Cukup impor sekali untuk instalasi baru.

4. Periksa konfigurasi koneksi di [`koneksi.php`](./koneksi.php). Nilai bawaan proyek:

   - Host: `localhost`
   - User: `root`
   - Password: kosong
   - Database: `absensi`

   Sesuaikan nilai pada file tersebut jika konfigurasi MySQL lokal Anda berbeda.

5. Buka aplikasi melalui URL web server, misalnya `http://localhost/Sistem-absensi-siswa/`.

### Menjalankan dengan PHP built-in server

Dari folder proyek, jalankan:

```bash
php -S 127.0.0.1:8089
```

Kemudian buka `http://127.0.0.1:8089/`.

## Navigasi

- **Absensi** (`index.php?page=home`): mencatat dan mengelola kehadiran.
- **Data siswa** (`index.php?page=data`): melihat dan mengelola informasi siswa.
- **Tambah siswa** (`index.php?page=tambah`): memasukkan siswa baru.

## Catatan

- Koneksi database pada konfigurasi bawaan memakai akun lokal tanpa password. Untuk lingkungan selain pengembangan lokal, gunakan kredensial database yang sesuai.
- Aplikasi ini belum menyediakan autentikasi pengguna.
