<?php
include 'koneksi.php';
if(isset($_POST['akun'])){
    $noreg = $_POST['noreg'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT into akun values($noreg,'$nama','$alamat')";
    mysqli_query($koneksi,$sql);
    if(true){
        header('location:index.php');
    }

}
?>