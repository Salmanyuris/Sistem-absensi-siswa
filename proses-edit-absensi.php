<?php
require_once "app-helpers.php";
require_once "koneksi.php";

if (!$koneksi) {
    show_page_error(503, "Database belum siap", "Pastikan MySQL aktif dan database absensi tersedia.", "index.php?page=home", $databaseError);
}

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["simpan"])) {
    show_page_error(405, "Permintaan tidak valid", "Formulir perubahan absensi harus dikirim melalui halaman edit.", "index.php?page=home");
}

$nis = request_string($_POST, "nis");
$nama = request_string($_POST, "nama");
$jamAbsen = request_string($_POST, "jam_absen");
$tanggal = request_string($_POST, "tanggal");

if (!is_valid_nis($nis) || $nama === "" || !is_valid_time($jamAbsen) || !is_valid_date($tanggal)) {
    show_page_error(400, "Data absensi belum lengkap", "Periksa kembali NIS, nama, jam, dan tanggal absensi.", "index.php?page=home");
}

$statement = mysqli_prepare(
    $koneksi,
    "UPDATE absen SET nama = ?, jam_absen = ?, tanggal = ? WHERE nis = ?"
);
if (!$statement) {
    show_page_error(500, "Perubahan absensi gagal disimpan", "Permintaan perubahan absensi tidak dapat disiapkan.", "index.php?page=home", mysqli_error($koneksi));
}

mysqli_stmt_bind_param($statement, "sssi", $nama, $jamAbsen, $tanggal, $nis);
if (!mysqli_stmt_execute($statement)) {
    show_page_error(500, "Perubahan absensi gagal disimpan", "Periksa data yang dimasukkan, lalu coba lagi.", "index.php?page=home", mysqli_stmt_error($statement));
}

mysqli_stmt_close($statement);
redirect_to("index.php?page=home");
