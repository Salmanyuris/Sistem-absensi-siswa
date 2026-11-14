<?php
require_once "app-helpers.php";
require_once "koneksi.php";

if (!$koneksi) {
    show_page_error(503, "Database belum siap", "Pastikan MySQL aktif dan database absensi tersedia.", "index.php?page=data", $databaseError);
}

$nis = request_string($_GET, "id");
if (!is_valid_nis($nis)) {
    show_page_error(400, "NIS tidak valid", "Data siswa tidak dapat dihapus karena NIS tidak valid.", "index.php?page=data");
}

$statement = mysqli_prepare($koneksi, "DELETE FROM siswa WHERE nis = ?");
if (!$statement) {
    show_page_error(500, "Siswa gagal dihapus", "Permintaan penghapusan siswa tidak dapat disiapkan.", "index.php?page=data", mysqli_error($koneksi));
}

mysqli_stmt_bind_param($statement, "i", $nis);
if (!mysqli_stmt_execute($statement)) {
    show_page_error(500, "Siswa gagal dihapus", "Terjadi kesalahan saat menghapus data siswa.", "index.php?page=data", mysqli_stmt_error($statement));
}

if (mysqli_stmt_affected_rows($statement) === 0) {
    mysqli_stmt_close($statement);
    show_page_error(404, "Siswa tidak ditemukan", "Data siswa yang ingin dihapus sudah tidak tersedia.", "index.php?page=data");
}

mysqli_stmt_close($statement);
redirect_to("index.php?page=data");
