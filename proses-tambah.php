<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];

    $sql = "INSERT INTO siswa values ('$nis','$nama','$alamat','$jenis_kelamin','$agama')";
    $tambah = mysqli_query($koneksi, $sql);
    if ($tambah) {
        header("Location:index.php?page=data");
    }
}
