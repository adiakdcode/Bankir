<?php
include 'koneksi.php';
if(isset($_GET['accept'])){
    $sql = "update user set level=1 where id_user=$_GET[accept]";
    mysqli_query($koneksi,$sql);
    if(true){
        header("location:index.php");
    }
}
if(isset($_GET['deny'])){
    $sql = "delete from user where id_user=$_GET[deny]";
    mysqli_query($koneksi,$sql);
    if(true){
        header("location:index.php");
    }
}
?>