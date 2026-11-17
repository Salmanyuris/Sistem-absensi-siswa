<?php
require_once "app-helpers.php";
require_once "koneksi.php";

if (!$koneksi) {
    show_page_error(503, "Database belum siap", "Pastikan MySQL aktif dan database absensi tersedia.", "index.php?page=home", $databaseError);
}

$nis = request_string($_GET, "nis");
$tanggal = request_string($_GET, "tanggal");
if (!is_valid_nis($nis) || !is_valid_date($tanggal)) {
    show_page_error(400, "Data absensi tidak valid", "Data absensi tidak dapat dihapus karena NIS atau tanggal tidak valid.", "index.php?page=home");
}

$statement = mysqli_prepare($koneksi, "DELETE FROM absen WHERE nis = ? AND tanggal = ?");
if (!$statement) {
    show_page_error(500, "Absensi gagal dihapus", "Permintaan penghapusan absensi tidak dapat disiapkan.", "index.php?page=home", mysqli_error($koneksi));
}

mysqli_stmt_bind_param($statement, "is", $nis, $tanggal);
if (!mysqli_stmt_execute($statement)) {
    show_page_error(500, "Absensi gagal dihapus", "Terjadi kesalahan saat menghapus data absensi.", "index.php?page=home", mysqli_stmt_error($statement));
}

if (mysqli_stmt_affected_rows($statement) === 0) {
    mysqli_stmt_close($statement);
    show_page_error(404, "Absensi tidak ditemukan", "Data absensi yang ingin dihapus sudah tidak tersedia.", "index.php?page=home");
}

mysqli_stmt_close($statement);
redirect_to("index.php?page=home");
