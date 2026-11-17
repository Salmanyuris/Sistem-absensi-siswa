<?php
require_once "app-helpers.php";
require_once "koneksi.php";

if (!$koneksi) {
    show_page_error(503, "Database belum siap", "Pastikan MySQL aktif dan database absensi tersedia.", "index.php?page=data", $databaseError);
}

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["simpan"])) {
    show_page_error(405, "Permintaan tidak valid", "Formulir perubahan siswa harus dikirim melalui halaman edit.", "index.php?page=data");
}

$nis = request_string($_POST, "nis");
$nama = request_string($_POST, "nama");
$kelas = request_string($_POST, "kelas");
$alamat = request_string($_POST, "alamat");
$jenisKelamin = request_string($_POST, "jenis_kelamin");
$agama = request_string($_POST, "agama");

if (
    !is_valid_nis($nis)
    || $nama === ""
    || !is_valid_class($kelas)
    || $alamat === ""
    || !in_array($jenisKelamin, array("pria", "wanita"), true)
    || !in_array($agama, array("islam", "kristen", "budha", "katholik"), true)
) {
    show_page_error(400, "Data siswa belum lengkap", "Periksa kembali seluruh kolom dan pastikan NIS berupa angka yang valid.", "index.php?page=data");
}

$statement = mysqli_prepare(
    $koneksi,
    "UPDATE siswa SET nama = ?, kelas = ?, alamat = ?, jenis_kelamin = ?, agama = ? WHERE nis = ?"
);
if (!$statement) {
    show_page_error(500, "Perubahan siswa gagal disimpan", "Permintaan perubahan siswa tidak dapat disiapkan.", "index.php?page=data", mysqli_error($koneksi));
}

mysqli_stmt_bind_param($statement, "sssssi", $nama, $kelas, $alamat, $jenisKelamin, $agama, $nis);
if (!mysqli_stmt_execute($statement)) {
    show_page_error(500, "Perubahan siswa gagal disimpan", "Periksa data yang dimasukkan, lalu coba lagi.", "index.php?page=data", mysqli_stmt_error($statement));
}

mysqli_stmt_close($statement);
redirect_to("index.php?page=data");
