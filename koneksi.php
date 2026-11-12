<?php
$databaseError = null;

try {
    $koneksi = @mysqli_connect("localhost", "root", "", "absensi");
} catch (mysqli_sql_exception $exception) {
    $koneksi = false;
    $databaseError = $exception->getMessage();
}

if (!$koneksi && $databaseError === null) {
    $databaseError = mysqli_connect_error();
}
