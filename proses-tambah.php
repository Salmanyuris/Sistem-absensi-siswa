<?php
require_once "app-helpers.php";
require_once "koneksi.php";

if (!$koneksi) {
    show_page_error(503, "Database belum siap", "Pastikan MySQL aktif dan database absensi tersedia.", "index.php?page=data", $databaseError);
}

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["simpan"])) {
    show_page_error(405, "Permintaan tidak valid", "Formulir penambahan siswa harus dikirim melalui halaman siswa.", "index.php?page=data");
}

$nis = request_string($_POST, "nis");
$nama = request_string($_POST, "nama");
$alamat = request_string($_POST, "alamat");
$jenisKelamin = request_string($_POST, "jenis_kelamin");
$agama = request_string($_POST, "agama");

if (
    !is_valid_nis($nis)
    || $nama === ""
    || $alamat === ""
    || !in_array($jenisKelamin, array("pria", "wanita"), true)
    || !in_array($agama, array("islam", "kristen", "budha", "katholik"), true)
) {
    show_page_error(400, "Data siswa belum lengkap", "Periksa kembali seluruh kolom dan pastikan NIS berupa angka yang valid.", "index.php?page=tambah");
}

$statement = mysqli_prepare(
    $koneksi,
    "INSERT INTO siswa (nis, nama, alamat, jenis_kelamin, agama) VALUES (?, ?, ?, ?, ?)"
);
if (!$statement) {
    show_page_error(500, "Siswa gagal disimpan", "Permintaan penyimpanan siswa tidak dapat disiapkan.", "index.php?page=tambah", mysqli_error($koneksi));
}

mysqli_stmt_bind_param($statement, "issss", $nis, $nama, $alamat, $jenisKelamin, $agama);
if (!mysqli_stmt_execute($statement)) {
    show_page_error(500, "Siswa gagal disimpan", "Periksa NIS dan data yang dimasukkan, lalu coba lagi.", "index.php?page=tambah", mysqli_stmt_error($statement));
}

mysqli_stmt_close($statement);
redirect_to("index.php?page=data");
