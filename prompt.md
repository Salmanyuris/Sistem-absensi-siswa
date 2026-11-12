# MASTER PROMPT PENGEMBANGAN SISTEM ABSENSI SISWA SMK WARNA DUNIA

## 1. PERAN DAN INSTRUKSI UTAMA

Anda bertindak sebagai Senior Full-Stack Web Developer, System Analyst, UI/UX Designer, dan Database Engineer.

Anda bertugas melanjutkan dan mengembangkan proyek **Sistem Absensi Siswa SMK Warna Dunia** menjadi aplikasi web administrasi sekolah yang lebih lengkap, modern, responsif, aman, dan mudah digunakan.

Sistem dikembangkan menggunakan PHP prosedural dan MySQL/MariaDB tanpa framework PHP.

**Instruksi terpenting:**

1. Periksa seluruh struktur proyek dan kode yang sudah tersedia sebelum melakukan perubahan.
2. Pahami hubungan antarhalaman, proses CRUD, database, dan dependensi yang digunakan.
3. Jangan membuat ulang proyek dari awal jika implementasi yang tersedia masih dapat digunakan.
4. Pertahankan fitur lama yang masih relevan.
5. Implementasikan fitur baru secara bertahap dan terintegrasi.
6. Jangan membuat tombol, menu, atau fitur yang hanya menjadi dekorasi. Semua fitur harus memiliki fungsi nyata.
7. Jangan membuat data dummy seolah-olah merupakan data asli.
8. Jangan menghapus atau mengubah data pengguna yang sudah ada tanpa persetujuan.
9. Pastikan seluruh halaman dapat berjalan dan terhubung dengan database.
10. Prioritaskan stabilitas, keamanan, kemudahan penggunaan, dan konsistensi desain.

---

## 2. TUJUAN PENGEMBANGAN

Mengembangkan Sistem Absensi Siswa SMK Warna Dunia menjadi sistem informasi sekolah yang mampu:

- Mengelola data siswa secara terpusat.
- Mengelola data kelas dan jurusan.
- Mengelola tahun ajaran dan semester.
- Melakukan pencatatan absensi siswa setiap hari.
- Mengelola status kehadiran siswa.
- Memantau statistik kehadiran melalui dashboard.
- Menyediakan laporan dan rekapitulasi absensi.
- Mengelola akun dan hak akses pengguna.
- Menyimpan riwayat aktivitas pengguna.
- Menyediakan fitur pencarian, filter, dan ekspor laporan.

Seluruh antarmuka menggunakan Bahasa Indonesia.

---

## 3. TEKNOLOGI DAN BATASAN PROYEK

Gunakan teknologi berikut:

**Backend:**
- PHP prosedural.
- MySQLi.
- MySQL atau MariaDB.
- PHP 7.3+ sebagai batas kompatibilitas dokumentasi awal.
- Session PHP untuk autentikasi.
- Prepared Statement untuk query yang menggunakan input pengguna.

**Frontend:**
- HTML5.
- CSS3.
- JavaScript.
- Bootstrap 5 lokal.
- Bootstrap Icons lokal apabila sudah tersedia.
- CSS kustom melalui style.css.

**Ketentuan:**
- Jangan menggunakan Laravel, CodeIgniter, atau framework PHP lainnya.
- Jangan menggunakan Node.js sebagai backend.
- Jangan mewajibkan Composer atau package manager.
- Jangan menggunakan CDN apabila aset lokal sudah tersedia.
- Jangan menambahkan layanan berbayar.
- Jangan menambahkan dependensi eksternal tanpa kebutuhan yang jelas.

Periksa versi PHP, MySQL/MariaDB, Bootstrap, serta struktur aset sebelum menentukan implementasi.

---

## 4. DESAIN UI/UX

Buat desain aplikasi dengan konsep:

**Modern School Administration Dashboard**

Karakteristik desain:

- Clean, modern, profesional, dan minimalis.
- Sidebar navigasi di sebelah kiri.
- Header halaman dengan judul dan informasi pengguna.
- Dashboard menggunakan statistik berbentuk cards.
- Tabel dengan tampilan rapi dan mudah dibaca.
- Form menggunakan label yang jelas.
- Warna latar belakang netral.
- Gunakan warna biru sebagai warna utama identitas sekolah.
- Gunakan warna hijau untuk status berhasil.
- Gunakan warna merah untuk status gagal.
- Gunakan warna kuning/oranye untuk peringatan.
- Gunakan ikon yang konsisten.
- Gunakan border radius yang proporsional.
- Hindari penggunaan warna berlebihan dan elemen dekoratif yang tidak diperlukan.

**Layout responsif:**

Desktop:
- Sidebar tetap berada di sebelah kiri.
- Konten utama menggunakan ruang secara optimal.
- Statistik dashboard ditampilkan dalam beberapa kolom.
- Tabel dapat dibaca dengan nyaman.

Tablet:
- Sidebar dapat diperkecil atau disembunyikan.
- Komponen menyesuaikan lebar layar.

Mobile:
- Sidebar berubah menjadi offcanvas atau menu navigasi yang sesuai.
- Formulir menggunakan satu kolom.
- Tabel memiliki horizontal scrolling jika diperlukan.
- Tombol tetap mudah disentuh.
- Tidak boleh ada horizontal overflow pada keseluruhan halaman.

Gunakan komponen desain yang konsisten di seluruh halaman.

---

## 5. STRUKTUR MENU DAN NAVIGASI

Buat sidebar dengan kelompok menu berikut.

### A. Menu Utama
1. Dashboard.
2. Data Siswa.
3. Data Kelas.
4. Absensi Harian.
5. Riwayat Absensi.

### B. Menu Laporan
1. Rekapitulasi Absensi.
2. Laporan Siswa.
3. Cetak Laporan.

### C. Menu Pengaturan
1. Manajemen Pengguna.
2. Tahun Ajaran.
3. Log Aktivitas.
4. Pengaturan Sistem.

Menu yang ditampilkan harus menyesuaikan role pengguna yang sedang login.

---

## 6. DETAIL FITUR SISTEM

### 6.1. Dashboard

Halaman dashboard menjadi halaman utama setelah pengguna berhasil login.

Tampilkan informasi:

**Statistik siswa:**
- Total seluruh siswa.
- Total siswa aktif.
- Total siswa tidak aktif.
- Total kelas.

**Statistik absensi hari ini:**
- Total siswa hadir.
- Total siswa sakit.
- Total siswa izin.
- Total siswa alpa.
- Total siswa terlambat.
- Siswa yang belum diabsen.

**Visualisasi:**
- Grafik statistik kehadiran mingguan.
- Grafik statistik kehadiran bulanan.
- Persentase kehadiran.
- Distribusi status absensi.

**Aktivitas terbaru:**
- Aktivitas pencatatan absensi.
- Penambahan data siswa.
- Perubahan data siswa.
- Perubahan status absensi.

Seluruh statistik harus dihitung berdasarkan database aktual, bukan angka statis.

Tambahkan filter tanggal dan kelas apabila relevan.

### 6.2. Manajemen Data Siswa

Sediakan halaman pengelolaan siswa dengan fitur:

**Daftar siswa:**

Kolom tabel:
- No.
- NIS.
- Nama lengkap.
- Jenis kelamin.
- Kelas.
- Jurusan.
- Nomor telepon.
- Status siswa.
- Aksi.

**Fitur:**
- Tambah siswa.
- Lihat detail siswa.
- Edit siswa.
- Hapus siswa.
- Cari berdasarkan NIS atau nama.
- Filter berdasarkan kelas.
- Filter berdasarkan jurusan.
- Filter berdasarkan jenis kelamin.
- Filter berdasarkan status siswa.
- Pagination.
- Pengurutan data.

**Form tambah dan edit siswa:**

Field:
- NIS.
- Nama lengkap.
- Jenis kelamin.
- Tempat lahir.
- Tanggal lahir.
- Alamat.
- Agama.
- Nomor telepon.
- Nama orang tua/wali.
- Nomor telepon orang tua/wali.
- Kelas.
- Jurusan.
- Status siswa.

Validasi:
- NIS wajib diisi dan unik.
- Nama wajib diisi.
- Jenis kelamin wajib dipilih.
- Kelas wajib dipilih jika pengelompokan kelas sudah diterapkan.
- Nomor telepon divalidasi.
- Data yang tidak lengkap harus menghasilkan pesan validasi yang jelas.

Sediakan halaman detail siswa yang menampilkan identitas dan ringkasan riwayat kehadiran.

Siswa yang sudah memiliki riwayat absensi sebaiknya dinonaktifkan daripada dihapus secara permanen.

### 6.3. Manajemen Data Kelas

Sediakan fitur untuk mengelola kelas.

**Informasi kelas:**
- ID kelas.
- Nama kelas.
- Tingkat kelas.
- Jurusan.
- Wali kelas.
- Tahun ajaran.
- Status kelas.

**Fitur:**
- Tambah kelas.
- Edit kelas.
- Detail kelas.
- Hapus kelas dengan pemeriksaan relasi data.
- Pencarian kelas.
- Filter berdasarkan tingkat dan jurusan.
- Melihat daftar siswa dalam kelas.

Satu kelas dapat memiliki banyak siswa.

Setiap siswa harus terhubung dengan kelas yang sesuai.

Pemindahan siswa ke kelas lain harus mempertahankan histori kelas sebelumnya apabila histori tersebut sudah diterapkan.

### 6.4. Manajemen Tahun Ajaran dan Semester

Buat modul pengelolaan tahun ajaran.

Field:
- Tahun ajaran, contoh 2026/2027.
- Semester Ganjil atau Genap.
- Tanggal mulai.
- Tanggal berakhir.
- Status aktif.

Ketentuan:
- Hanya satu periode aktif untuk kombinasi tahun ajaran dan semester yang digunakan.
- Absensi harus terhubung dengan periode akademik.
- Pengguna dapat melihat laporan periode sebelumnya.
- Periode yang sudah memiliki data tidak boleh dihapus sembarangan.

### 6.5. Absensi Harian

Ini merupakan fitur utama aplikasi.

Sediakan halaman pencatatan absensi berdasarkan kelas dan tanggal.

**Alur:**

1. Pengguna membuka menu Absensi Harian.
2. Pengguna memilih tanggal.
3. Pengguna memilih kelas.
4. Sistem menampilkan daftar siswa aktif pada kelas tersebut.
5. Pengguna menentukan status kehadiran masing-masing siswa.
6. Pengguna dapat menambahkan keterangan.
7. Pengguna menyimpan absensi.
8. Sistem memvalidasi data dan menyimpan hasilnya.
9. Sistem menampilkan notifikasi berhasil atau gagal.

**Status kehadiran:**
- Hadir.
- Sakit.
- Izin.
- Alpa.
- Terlambat.

**Kolom tabel absensi:**
- No.
- NIS.
- Nama siswa.
- Kelas.
- Status kehadiran.
- Jam masuk.
- Keterangan.
- Aksi.

**Fitur tambahan:**
- Tombol tandai semua hadir.
- Tombol reset status.
- Pencatatan absensi massal.
- Edit status kehadiran.
- Pencarian siswa.
- Filter status.
- Penambahan keterangan.
- Indikator siswa yang belum diabsen.
- Konfirmasi sebelum menyimpan.

**Aturan bisnis:**

1. Satu siswa hanya boleh memiliki satu catatan absensi per tanggal dan sesi absensi yang sama.
2. Sistem tidak boleh menyimpan absensi ganda.
3. Siswa tidak boleh diabsen apabila berstatus tidak aktif.
4. Data absensi harus terhubung dengan NIS.
5. Jam masuk menggunakan waktu server yang telah dikonfigurasi.
6. Jika absensi sudah tersimpan, perubahan harus melalui proses edit.
7. Semua perubahan penting dicatat dalam log aktivitas.
8. Absensi tidak boleh otomatis dianggap berhasil jika query database gagal.

Jika diperlukan, sediakan status belum diabsen sebagai kondisi tampilan, bukan sebagai status kehadiran yang otomatis disimpan.

### 6.6. Riwayat Absensi

Buat halaman khusus untuk melihat seluruh catatan absensi.

Kolom:
- No.
- Tanggal.
- NIS.
- Nama siswa.
- Kelas.
- Jam masuk.
- Status kehadiran.
- Keterangan.
- Aksi.

Fitur:
- Pencarian nama atau NIS.
- Filter tanggal.
- Filter kelas.
- Filter status.
- Edit absensi.
- Detail absensi.
- Pagination.
- Pengurutan berdasarkan tanggal.

Penghapusan data absensi harus menggunakan konfirmasi dan dicatat dalam log aktivitas.

### 6.7. Rekapitulasi Absensi

Buat modul rekapitulasi untuk melihat statistik kehadiran siswa.

**Rekap per siswa:**
- NIS.
- Nama siswa.
- Kelas.
- Total hadir.
- Total sakit.
- Total izin.
- Total alpa.
- Total terlambat.
- Persentase kehadiran.

**Rekap per kelas:**
- Nama kelas.
- Jumlah siswa.
- Total kehadiran.
- Total sakit.
- Total izin.
- Total alpa.
- Total terlambat.
- Rata-rata persentase kehadiran.

**Filter laporan:**
- Harian.
- Mingguan.
- Bulanan.
- Rentang tanggal.
- Tahun ajaran.
- Semester.
- Kelas.
- Siswa tertentu.

Gunakan rumus:

Persentase kehadiran = (Jumlah hadir / Jumlah hari yang dihitung) x 100%.

Pastikan definisi hari yang dihitung konsisten. Hari libur, akhir pekan, dan hari tanpa kegiatan sekolah tidak boleh otomatis dimasukkan sebagai ketidakhadiran.

Status terlambat tetap dapat dihitung sebagai kehadiran, tetapi harus ditampilkan secara terpisah.

### 6.8. Laporan dan Ekspor Data

Sediakan fitur pembuatan laporan.

Jenis laporan:
- Laporan absensi harian.
- Laporan absensi bulanan.
- Laporan kehadiran per kelas.
- Laporan kehadiran per siswa.
- Laporan keseluruhan siswa.

Fitur:
- Preview laporan.
- Filter sebelum laporan dibuat.
- Cetak menggunakan print stylesheet.
- Ekspor CSV yang kompatibel dengan Microsoft Excel.
- Format laporan yang rapi dan profesional.

Header laporan menampilkan:
- Nama SMK Warna Dunia.
- Judul laporan.
- Periode laporan.
- Kelas.
- Tanggal pembuatan.
- Informasi petugas.

Jangan mengklaim ekspor Excel XLSX jika implementasinya hanya menghasilkan CSV.

### 6.9. Manajemen Pengguna dan Autentikasi

Tambahkan sistem login dan logout.

**Form login:**
- Username.
- Password.
- Tombol tampilkan/sembunyikan password.
- Validasi akun.
- Pesan kesalahan yang informatif tetapi tidak membocorkan informasi sensitif.

**Role pengguna:**

1. Super Admin:
   - Akses seluruh fitur.
   - Mengelola pengguna.
   - Mengelola siswa dan kelas.
   - Mengelola absensi.
   - Mengelola laporan.
   - Mengelola konfigurasi sistem.

2. Admin:
   - Mengelola data siswa.
   - Mengelola kelas.
   - Mengelola absensi.
   - Melihat laporan.

3. Guru:
   - Melihat data siswa sesuai hak akses.
   - Melakukan pencatatan absensi.
   - Melihat riwayat absensi yang diizinkan.

4. Wali Kelas:
   - Melihat siswa pada kelas yang menjadi tanggung jawabnya.
   - Mengelola absensi kelas sesuai izin.
   - Melihat rekapitulasi kelas.

**Ketentuan keamanan:**
- Gunakan password_hash() untuk menyimpan password.
- Gunakan password_verify() untuk memverifikasi password.
- Regenerasi session ID setelah login.
- Gunakan pemeriksaan session pada setiap halaman terlindungi.
- Batasi akses berdasarkan role.
- Terapkan logout yang menghapus session.
- Jangan menyimpan password dalam bentuk teks biasa.

Jangan menyediakan akun default dengan password produksi yang mudah ditebak.

### 6.10. Profil Pengguna

Sediakan halaman profil pengguna.

Fitur:
- Melihat nama pengguna.
- Melihat username.
- Melihat role.
- Mengubah nama.
- Mengubah password.
- Melihat informasi akun.

Perubahan password harus memerlukan verifikasi password lama.

### 6.11. Log Aktivitas

Buat pencatatan aktivitas pengguna.

Catat aktivitas seperti:
- Login.
- Logout.
- Tambah siswa.
- Edit siswa.
- Nonaktifkan siswa.
- Tambah absensi.
- Edit absensi.
- Hapus absensi.
- Pengelolaan kelas.
- Perubahan konfigurasi.

Informasi log:
- ID aktivitas.
- ID pengguna.
- Nama pengguna.
- Jenis aktivitas.
- Deskripsi.
- Tanggal dan waktu.

Log aktivitas hanya dapat dilihat oleh pengguna dengan hak akses yang sesuai.

---

## 7. RANCANGAN DATABASE

Evaluasi skema database yang sudah ada sebelum mengembangkan fitur baru.

Database awal menggunakan:

- siswa.
- absen.

Skema lama memiliki keterbatasan karena NIS menjadi primary key pada tabel absen sehingga hanya memungkinkan satu catatan absensi untuk setiap siswa.

Untuk mendukung absensi berulang setiap hari, diperlukan migrasi database.

**Jangan mempertahankan keterbatasan tersebut jika fitur absensi harian sudah diminta. Namun, jangan pula langsung mengubah database tanpa membuat rencana migrasi dan backup.**

Rancang skema database yang mendukung kebutuhan berikut:

### Tabel users
- id.
- nama.
- username.
- password.
- role.
- status.
- created_at.
- updated_at.

### Tabel siswa
- nis.
- nama.
- jenis_kelamin.
- tempat_lahir.
- tanggal_lahir.
- alamat.
- agama.
- no_telepon.
- nama_wali.
- no_telepon_wali.
- id_kelas.
- status.
- created_at.
- updated_at.

### Tabel jurusan
- id_jurusan.
- nama_jurusan.
- kode_jurusan.

### Tabel kelas
- id_kelas.
- nama_kelas.
- tingkat.
- id_jurusan.
- id_wali_kelas.
- status.

### Tabel tahun_ajaran
- id_tahun_ajaran.
- nama_tahun_ajaran.
- semester.
- tanggal_mulai.
- tanggal_selesai.
- status.

### Tabel absen
- id_absen.
- nis.
- id_kelas.
- id_tahun_ajaran.
- tanggal.
- jam_masuk.
- status_kehadiran.
- keterangan.
- id_user.
- created_at.
- updated_at.

Buat unique constraint untuk mencegah absensi ganda berdasarkan siswa, tanggal, dan sesi absensi.

### Tabel log_aktivitas
- id_log.
- id_user.
- aktivitas.
- deskripsi.
- created_at.

**Catatan desain database:**

1. Sesuaikan nama dan tipe kolom dengan implementasi aktual.
2. Gunakan foreign key apabila struktur database mendukungnya.
3. Tentukan primary key yang tepat.
4. Tambahkan indeks untuk kolom pencarian dan filter.
5. Gunakan transaksi database untuk operasi yang melibatkan beberapa tabel.
6. Tentukan aturan ON DELETE dan ON UPDATE secara hati-hati.
7. Pertahankan data lama melalui migrasi yang dapat diperiksa.
8. Buat file migrasi terpisah dari absensi.sql.
9. Sediakan backup sebelum perubahan skema.
10. Jangan menghapus data absensi lama ketika melakukan migrasi.

Jika diperlukan, tambahkan tabel histori kelas siswa agar perpindahan kelas tidak menghilangkan riwayat akademik.

---

## 8. KEAMANAN APLIKASI

Terapkan praktik keamanan berikut:

- Prepared Statement MySQLi.
- Validasi input pada server.
- Escape output menggunakan htmlspecialchars().
- Perlindungan CSRF pada seluruh formulir yang mengubah data.
- Validasi session dan role.
- Password hashing.
- Pembatasan akses langsung ke halaman proses.
- Validasi ID dan parameter URL.
- Validasi data sebelum operasi CRUD.
- Konfirmasi sebelum penghapusan.
- Gunakan POST untuk operasi yang mengubah data.
- Hindari menampilkan error database internal kepada pengguna.
- Simpan detail error untuk debugging server.
- Jangan menampilkan kredensial database.
- Hindari SQL Injection, XSS, CSRF, dan akses tanpa otorisasi.

Gunakan mekanisme flash message untuk notifikasi berhasil dan gagal.

---

## 9. STRUKTUR DIREKTORI YANG DISARANKAN

Pertahankan struktur yang sudah ada jika masih relevan. Jika proyek perlu dirapikan, gunakan struktur modular seperti berikut:

```text
absensi-sekolah/
│
├── index.php
├── login.php
├── logout.php
├── koneksi.php
├── config.php
│
├── includes/
│   ├── auth.php
│   ├── middleware.php
│   ├── header.php
│   ├── sidebar.php
│   ├── navbar.php
│   ├── footer.php
│   ├── functions.php
│   └── flash-message.php
│
├── pages/
│   ├── dashboard.php
│   ├── siswa/
│   ├── kelas/
│   ├── jurusan/
│   ├── absensi/
│   ├── laporan/
│   ├── pengguna/
│   ├── tahun-ajaran/
│   ├── log-aktivitas/
│   └── pengaturan/
│
├── actions/
│   ├── siswa/
│   ├── kelas/
│   ├── absensi/
│   ├── pengguna/
│   └── laporan/
│
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   ├── bootstrap/
│   ├── icons/
│   └── images/
│
├── database/
│   ├── absensi.sql
│   ├── migrations/
│   └── backup/
│
├── uploads/
│
├── README.md
└── .gitignore
```

Struktur ini merupakan target yang disarankan, bukan kewajiban untuk memindahkan semua file sekaligus.

Jangan sampai pemindahan file merusak URL lama, proses CRUD, atau aset yang masih digunakan.

Folder uploads harus memiliki validasi file dan pembatasan akses. Jangan izinkan file PHP dieksekusi dari folder tersebut.

---

## 10. PENANGANAN ERROR DAN KONDISI DATABASE

Sistem harus mampu menangani:

1. Database belum dibuat.
2. Koneksi database gagal.
3. Tabel belum tersedia.
4. Query gagal.
5. Data tidak ditemukan.
6. NIS duplikat.
7. Absensi sudah tercatat.
8. Session kedaluwarsa.
9. Pengguna tidak memiliki hak akses.
10. Input formulir tidak valid.

Tampilkan pesan yang mudah dipahami.

Contoh:

- "Koneksi database gagal. Periksa konfigurasi koneksi."
- "Data siswa tidak ditemukan."
- "NIS sudah digunakan oleh siswa lain."
- "Absensi siswa untuk tanggal tersebut sudah tercatat."
- "Anda tidak memiliki akses untuk membuka halaman ini."

Jangan pernah menampilkan notifikasi berhasil apabila operasi database gagal.

---

## 11. PENGUJIAN SISTEM

Setelah implementasi, lakukan pengujian terhadap seluruh fitur.

### Pengujian autentikasi
- Login dengan akun valid.
- Login dengan password salah.
- Logout.
- Akses halaman tanpa login.
- Akses halaman dengan role berbeda.
- Session kedaluwarsa.

### Pengujian siswa
- Tambah siswa.
- Edit siswa.
- Detail siswa.
- Hapus atau nonaktifkan siswa.
- NIS duplikat.
- Pencarian.
- Filter.
- Validasi input kosong.

### Pengujian kelas
- Tambah kelas.
- Edit kelas.
- Hubungkan siswa ke kelas.
- Pindahkan siswa.
- Hapus kelas yang masih digunakan.

### Pengujian absensi
- Absensi hadir.
- Absensi sakit.
- Absensi izin.
- Absensi alpa.
- Absensi terlambat.
- Absensi massal.
- Absensi berulang pada tanggal berbeda.
- Absensi ganda pada tanggal sama.
- Edit absensi.
- Validasi siswa tidak aktif.

### Pengujian laporan
- Rekap harian.
- Rekap mingguan.
- Rekap bulanan.
- Rekap per kelas.
- Rekap per siswa.
- Filter rentang tanggal.
- Ekspor CSV.
- Cetak laporan.

### Pengujian keamanan
- SQL Injection.
- XSS.
- CSRF.
- Akses tanpa login.
- Akses tanpa hak.
- Manipulasi ID melalui URL.

Pastikan semua pengujian dilakukan berdasarkan implementasi nyata.

---

## 12. TAHAPAN PENGEMBANGAN

Kerjakan proyek menggunakan tahapan berikut.

### Tahap 1 — Audit proyek
- Periksa seluruh file.
- Periksa database.
- Periksa struktur folder.
- Identifikasi fitur yang sudah tersedia.
- Identifikasi bug dan keterbatasan.
- Buat daftar perubahan yang diperlukan.

### Tahap 2 — Perencanaan database
- Rancang skema baru.
- Identifikasi hubungan antartabel.
- Buat migration SQL.
- Buat mekanisme backup.
- Pastikan data lama tetap aman.

### Tahap 3 — Fondasi aplikasi
- Rapikan struktur kode.
- Buat autentikasi.
- Buat session management.
- Buat role dan middleware.
- Buat template layout utama.
- Buat komponen notifikasi.

### Tahap 4 — Modul administrasi
- Dashboard.
- Data siswa.
- Data jurusan.
- Data kelas.
- Tahun ajaran.
- Manajemen pengguna.

### Tahap 5 — Modul absensi
- Absensi harian.
- Absensi massal.
- Riwayat absensi.
- Edit absensi.
- Validasi absensi ganda.

### Tahap 6 — Modul laporan
- Rekapitulasi absensi.
- Statistik kehadiran.
- Filter laporan.
- Ekspor CSV.
- Cetak laporan.

### Tahap 7 — Keamanan dan pengujian
- Pengujian seluruh fitur.
- Pemeriksaan query.
- Pengujian akses role.
- Pengujian responsivitas.
- Perbaikan bug.

### Tahap 8 — Dokumentasi
- Perbarui README.md.
- Dokumentasikan instalasi.
- Dokumentasikan konfigurasi database.
- Dokumentasikan akun dan role tanpa menyertakan password rahasia.
- Dokumentasikan proses migrasi.

---

## 13. STANDAR KUALITAS HASIL AKHIR

Pastikan hasil akhir memenuhi kriteria berikut:

1. Seluruh fitur utama berfungsi.
2. Seluruh halaman terhubung dengan database.
3. Data tidak hilang akibat perubahan kode.
4. Tidak ada error PHP yang mengganggu aplikasi.
5. Tidak ada query yang menggunakan input pengguna secara tidak aman.
6. Hak akses pengguna berjalan sesuai role.
7. Absensi dapat dilakukan berulang pada tanggal berbeda.
8. Absensi ganda dapat dicegah.
9. Statistik dashboard sesuai data aktual.
10. Rekapitulasi sesuai data absensi.
11. Laporan dapat dicetak dan diekspor.
12. Desain konsisten dan responsif.
13. Navigasi tidak memiliki link yang rusak.
14. Tidak ada tombol yang tidak memiliki fungsi.
15. README.md dapat digunakan sebagai panduan instalasi.

---

## 14. FORMAT LAPORAN SETIAP SELESAI MENGERJAKAN

Setelah menyelesaikan pekerjaan, berikan laporan dengan format:

**A. Analisis**
- Kondisi proyek sebelumnya.
- Permasalahan yang ditemukan.
- Solusi yang diterapkan.

**B. Implementasi**
- Fitur yang berhasil dibuat.
- Fitur lama yang diperbaiki.
- Alur sistem yang berubah.

**C. File yang diubah**
- Nama file.
- Fungsi perubahan.
- File baru yang ditambahkan.

**D. Database**
- Tabel yang dibuat atau diubah.
- Relasi tabel.
- Migration yang diperlukan.
- Dampak terhadap data lama.

**E. Pengujian**
- Fitur yang sudah diuji.
- Hasil pengujian.
- Error yang ditemukan.
- Keterbatasan yang belum terselesaikan.

**F. Langkah selanjutnya**
- Fitur yang belum dikerjakan.
- Rekomendasi pengembangan berikutnya.

---

## 15. INSTRUKSI PERTAMA UNTUK AI CODING ASSISTANT

Jangan langsung mengubah seluruh kode proyek.

Mulailah dengan melakukan audit terhadap proyek Sistem Absensi Siswa SMK Warna Dunia yang tersedia.

Tugas pertama:

1. Baca seluruh file utama yang relevan.
2. Periksa struktur database dan relasi tabel.
3. Identifikasi fitur yang sudah berjalan.
4. Identifikasi fitur yang belum tersedia.
5. Identifikasi masalah keamanan dan potensi bug.
6. Bandingkan implementasi sekarang dengan rancangan fitur dalam prompt ini.
7. Buat laporan analisis kondisi proyek.
8. Susun prioritas implementasi berdasarkan dependensi fitur.

Setelah audit selesai, jelaskan rencana implementasi dan perubahan database yang diperlukan.

**Jangan melakukan perubahan destruktif sebelum mendapatkan persetujuan.**

Implementasikan fitur secara bertahap, pastikan setiap tahap berjalan dengan baik, kemudian lanjutkan ke tahap berikutnya.

Target akhirnya adalah menghasilkan **Sistem Absensi Siswa SMK Warna Dunia yang lengkap, modern, responsif, aman, dan siap digunakan untuk kebutuhan administrasi sekolah.**