<?php
include 'koneksi.php';
if(isset($_POST['transaksi'])){
    $noreg = $_POST['noreg'];
   
    $transaksi;
    if($_POST['opsi'] == "debit"){
        $transaksi = (int)$_POST['nominal'];
        $sql = "select sum(transaksi) from transaksi where id_akun = $noreg";
        $query = mysqli_query($koneksi,$sql);
        $row = mysqli_fetch_array($query);
        if((int)$row[0] <= $transaksi ){
           die;
        }else{
            $transaksi = 0 - (int)$_POST['nominal'];
        }
    }
    if($_POST['opsi'] == "kredit"){
        $transaksi = (int)$_POST['nominal'];
    }

    $sql = "INSERT into transaksi values(NULL,$noreg,$transaksi)";
    mysqli_query($koneksi,$sql);
    if(true){
        header('location:index.php');
    }
    
}
?>