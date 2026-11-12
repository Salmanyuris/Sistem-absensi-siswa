<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jam_absen = $_POST['jam_absen'];
    $tanggal = $_POST['tanggal'];
    $sql = "INSERT INTO absen values ('$nis','$nama','$jam_absen','$tanggal')";
    $tambah = mysqli_query($koneksi, $sql);
    if ($tambah) {
        header("Location:index.php?page=home");
    }
}
