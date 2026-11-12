<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jam_absen = $_POST['jam_absen'];
    $tanggal = $_POST['tanggal'];
    $sql = "UPDATE absen SET nama='$nama',jam_absen='$jam_absen',tanggal='$tanggal' WHERE nis='$nis'";
    $update = mysqli_query($koneksi, $sql);
    if ($update) {
        header("Location:index.php?page=home");
    }
}
