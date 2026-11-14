<?php
mysqli_report(MYSQLI_REPORT_OFF);

$databaseHost = "localhost";
$databaseUser = "root";
$databasePassword = "";
$databaseName = "absensi";

$koneksi = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);
$databaseError = $koneksi ? null : mysqli_connect_error();

if ($koneksi && !mysqli_set_charset($koneksi, "utf8mb4")) {
    $databaseError = mysqli_error($koneksi);
    mysqli_close($koneksi);
    $koneksi = false;
}
