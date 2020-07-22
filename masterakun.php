<?php
include 'koneksi.php';
if(isset($_POST['perbarui'])){
    $nama = $_POST['nama'];
    $noreg = $_POST['noreg'];
    $sql = "UPDATE akun set nama='$nama' where id_akun = $noreg";
    mysqli_query($koneksi,$sql);
    if(true){
        header('location:index.php');
    }
}
if(isset($_POST['delete'])){
    $noreg = $_POST['noreg'];
    $sql = "delete from transaksi where id_akun = $noreg";
    mysqli_query($koneksi,$sql);
    if(true){
        $sql = "delete from akun where id_akun = $noreg";
        mysqli_query($koneksi,$sql);
        if(true){
            header('location:index.php');
        }
    }
}
?>