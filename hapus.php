<?php
include"koneksi.php";
$nis=$_GET['id'];
$sql="DELETE FROM siswa WHERE nis='$nis'";
$hapus=mysqli_query($koneksi,$sql);
if ($hapus) {
    echo"<script>
    alert('data berhasil di hapus')
    window.location='index.php'
    </script>";
}

?>

