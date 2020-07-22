<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/materialize.css">
    <title>Login :: BANKIR</title>
    <link rel="icon" href="images/icon.png">
</head>
<body>
<main class="container">
    <div class="align-center" >
        <div class="card purple">
            <h4 class="white-text">Welcome to "BANKIR"</h4>
            <h5 class="white-text">Semakin Didepan untuk masa depan keuangan Anda</h5>
        </div>
        
        <h2 class="center"><img src="images/icon.png">Login to BANKIR</h2>
    <div class="center">
    <?php
    if(isset($_POST['signup'])){
        $sql = "INSERT into user values (NULL,'$_POST[username]','$_POST[password]',0)";
        $query = mysqli_query($koneksi,$sql);
        if(true){
            echo "<p>Selamat akun anda telah dibuat, tunggu konfirmasi admin </p>";
        }
    }
    ?>
    </div>
        <div class="container">
            <form action="" method="post">
                <table>
                    <tr>
                        <td><h5>Username<h5></td>
                        <td><input type="text" name="username" id="username"></td>
                    </tr>
                    <tr>
                        <td><h5>Password</h5></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="btn purple" value="Sign In" name="signin"></td>
                        <td><input type="submit" class="btn green" value="Sign Up" name="signup"></td>
                    </tr>
                </table>
            </form>
        </div>
    <?php
    if(isset($_POST['signin'])){
        $sql = "select * from user where username='$_POST[username]' and password='$_POST[password]' and level=1";
        $query = mysqli_query($koneksi,$sql);
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_array($query);
            $_SESSION['login'] = "true";
            
            $_SESSION['nama'] = "$row[username]";
            header('location:index.php');
        }else{
            echo "password atau username salah";
        }
    }
    ?>
    </div>
</main>

<div class="container">
    <footer class="page-footer purple">
      <div class="footer-copyright">
        <div class="container">
          © 2020 Adia | Wahyu | KHolik
          <a class="grey-text text-lighten-4 right" href="#">Home</a>
        </div>
      </div>
    </footer>
</div>

</body>
</html>
