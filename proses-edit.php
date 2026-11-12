<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sql = "UPDATE siswa SET nama='$nama',alamat='$alamat',jenis_kelamin='$jenis_kelamin',agama='$agama' WHERE nis='$nis'";
    $update = mysqli_query($koneksi, $sql);
    if ($update) {
        header("Location:index.php?page=data");
    }
}
