<?php
include "koneksi.php";
if(isset($_POST['change'])){
    $user = $_SESSION['nama'];
    $old = $_POST['oldpass'];
    $new = $_POST['newpass'];
    $konf = $_POST['konnewpass'];

    $sql = "select * from user where username='$user' and password='$old'";
    $query = mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($query) > 0){
        if($new == $konf){
            $sql = "update user set password='$new' where username='$user'";
            mysqli_query($koneksi,$sql);
            if(true){
                session_destroy();
                header("location:index.php");
            }
        }
    }
}
?>