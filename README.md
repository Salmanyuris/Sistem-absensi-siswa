# Sistem Absensi Siswa

Aplikasi web untuk mencatat kehadiran dan mengelola data siswa SMK Warna Dunia. Aplikasi dibuat dengan PHP dan MySQL, serta menggunakan Bootstrap untuk tampilan yang responsif.

## Fitur

- Mencatat, melihat, mengubah, dan menghapus data absensi.
- Menambah, melihat detail dan riwayat kehadiran, mengubah, dan menghapus data siswa.
- Mencari siswa berdasarkan NIS atau nama, memfilter jenis kelamin, mengurutkan, dan menelusuri data dengan pagination.
- Menampilkan informasi saat koneksi database bermasalah.

## Teknologi

- PHP dengan ekstensi MySQLi
- MySQL atau MariaDB
- Bootstrap 5 (tersedia di folder `assets/`)

## Persyaratan

- PHP 7.3 atau lebih baru dengan ekstensi `mysqli`. PHP CLI 8.2.12 tersedia di lingkungan pengembangan saat ini; versi minimum belum diuji langsung.
- MySQL atau MariaDB
- Web server lokal, seperti Laragon atau XAMPP. PHP built-in server juga dapat digunakan.

## Instalasi

1. Clone repository ke komputer Anda:

   ```bash
   git clone https://github.com/Salmanyuris/Sistem-absensi-siswa.git
   cd Sistem-absensi-siswa
   ```

2. Jalankan MySQL/MariaDB.

3. Buat database beserta tabel dengan mengimpor file [`absensi.sql`](./absensi.sql) melalui phpMyAdmin atau MySQL client. File ini membuat database `absensi`, tabel `siswa` dan `absen`, serta beberapa data contoh. Impor file satu kali untuk instalasi baru.

4. Sesuaikan pengaturan koneksi di [`koneksi.php`](./koneksi.php) jika konfigurasi MySQL lokal Anda berbeda. Nilai bawaan:

   | Pengaturan | Nilai |
   | --- | --- |
   | Host | `localhost` |
   | User | `root` |
   | Password | kosong |
   | Database | `absensi` |

5. Buka aplikasi melalui web server. Contoh URL jika menggunakan Laragon:

   ```text
   http://localhost/Sistem-absensi-siswa/
   ```

### Menjalankan dengan PHP built-in server

Dari folder proyek, jalankan:

```bash
php -S 127.0.0.1:8089
```

Pastikan MySQL/MariaDB tetap berjalan, lalu buka `http://127.0.0.1:8089/`.

## Navigasi

- **Absensi** (`index.php?page=home`): mencatat dan mengelola kehadiran siswa.
- **Data siswa** (`index.php?page=data`): melihat dan mengelola informasi siswa.
- **Detail siswa** (`index.php?page=detail&id=<NIS>`): melihat identitas dan ringkasan catatan kehadiran.
- **Tambah siswa** (`index.php?page=tambah`): memasukkan data siswa baru.

## Catatan

- Konfigurasi bawaan menggunakan akun database lokal tanpa password. Gunakan kredensial yang aman untuk lingkungan selain pengembangan lokal.
- Aplikasi belum menyediakan autentikasi pengguna.
