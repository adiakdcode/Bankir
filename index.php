<?php
include 'koneksi.php';
if(!$_SESSION['login'] == "true"){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/materialize.css">
    <title>BANKIR :: Bank No 1 di Indonesia</title>
    <link rel="icon" href="images/icon.png">
</head>
<body class="purple lighten-5">
    <!--Navbar Area -->
    <div class="navbar-fixed">
            <nav class="purple">
                <div class="nav-wrapper container">
                    <a href="#!" class="brand-logo">BANKIR</a>
                    <!-- Nav on mobile bug-->
                    <a href="#" data-target="mobile-nav" class="sidenav-trigger">☰</a>

                    <ul class="topnav right hide-on-med-and-down">
                        <li><a href="#home" onclick="contentIndex()" class="waves-effect white-text">Home</a></li>
                        <li><a href="#akun" onclick="contentAkun()" class="waves-effect">Nasabah</a></li>
                        <li><a href="#transaksi" onclick="contentTransaksi()" class="waves-effect">Input Transaksi</a></li>
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Detail ::</a>                      </li>
                        <ul id="dropdown1" class="dropdown-content">
                            <li><a href="#masterakun" onclick="contentMasterAkun()">Master Akun</a></li>
                            <li><a href="#masteruser" onclick="contentMasterUser()">Admin</a></li>
                            <li><a href="#laporan" onclick="contentLaporan()">Laporan Saldo</a></li>
                            <li><a href="#change" onclick="contentChange()">Ganti Password</a></li>
                        </ul>
                        <li><a href="#history" onclick="contentHistory()" class="waves-effect">History</a>
                        <li><a href="logout.php" ><h5>Logout</h5></a></li>
                    </ul>
                </div>
            </nav>
    </div>
    <!-- Area Kontent -->
    <div class="container" id="content"></div>
    <!-- Area footer-->
    <footer class="container purple">
      <div class="footer-copyright">
        <div>
          BANKIR © 2020 Adia | Wahyu | KHolik
          <a class="grey-text text-lighten-4 right" href="#">Home</a>
        </div>
      </div>
    </footer>
    
    
    <script>
    contentIndex();
    function contentIndex(){
        document.getElementById('content').innerHTML= `
                <h1>BANKIR</h1>
                <h4>Selamat datang di "BANKIR" yth.. <?= strtoupper($_SESSION['nama']) ?></h4>
                <p>**untuk mengganti menu klik Bagian Navigasi</p>
                <img src="images/banner_home.png">`;
    }
    function contentAkun(){
        document.getElementById('content').innerHTML = `
        <h1>Akun</h1>
        <p>Lengkapi data untuk membuat data baru. note: Harap isi dengan benar</p>
        <form action="akun.php" method="post">
            <table class="white">
                <tr >
                    <td><p>No Rekening :</p></td>
                    <td><input type="number" name="noreg" id="noreg" value="${Math.floor(Math.random() * 10000000000)}" readonly></td>
                </tr>
                <tr>
                    <td><p>Nama</pl></td>
                    <td><input type="text" name="nama" id="nama"></td>
                </tr>
                <tr>
                    <td><p>Alamat</p></td>
                    <td><textarea name="alamat" id="alamat" cols="80" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Simpan" name="akun" class="btn purple"></td>
                </tr>
            </table>
        </form>
        `;
    }
    function contentTransaksi(){
        document.getElementById('content').innerHTML=`
        <h2 class="center"><img src="images/icon.png">Transaksi BANKIR</h2>
        <form action="transaksi.php" method="post">
            <table>
                <tr class="card">
                    <td>No Rekening</td>
                    <td>
                        <select class="btn" name="noreg" id="noreg" onchange="tampilDetail()">
                            <?php
                            $sql = "select * from akun order by nama ASC";
                            $query = mysqli_query($koneksi,$sql);
                            while($row = mysqli_fetch_array($query)){
                            ?>
                            <option value='<?= $row["id_akun"] ?>' class><?php echo "$row[nama] - $row[id_akun]"; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr class="card">
                    <td>Pemasukan / Pengeluaran</td>
                    <td>
                        <select class="btn" name="opsi" id="opsi" onchange="nominal()">
                            <option>...</option>
                            <option value="kredit">Pemasukan</option>
                            <option value="debit">Pengeluaran</option>
                        </select>
                    </td>
                </tr>
                <tr id="nominal">
                    
                </tr>
                <tr id="konfir">

                </tr>
            </table>
        </form>
        `;
    }
    function nominal(){
        document.getElementById('nominal').innerHTML=`
        <td class="card purple white-text"><h6>Nominal Rp.</h6></td>
                <td><input type="number" name="nominal" onkeypress="konfir()"></td>
        `;
    }
    function konfir(){
        document.getElementById('konfir').innerHTML=`
        <td><input type="submit" value="Simpan" name="transaksi" class="btn purple"></td>
        `;
    }

    function contentLaporan(){
        document.getElementById('content').innerHTML=`
        <h1>Laporan</h1>
        <table class="striped responsive-table white">
            <tr>
                <th>No</th>
                <th>No Rekening</th>
                <th>Nama</th>
                <th>Saldo (Rp.)</th>
            </tr>
            <?php
            $sql = "select transaksi.id_akun,akun.nama,sum(transaksi.transaksi) from akun right join transaksi on transaksi.id_akun = akun.id_akun GROUP by transaksi.id_akun";
            $query = mysqli_query($koneksi,$sql);
            $no = 1;
            while($row= mysqli_fetch_array($query)){
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td width="20%"><?= $row[0] ?></td>
                <td width="20%"><?= $row[1] ?></td>
                <td width="60%">Rp.<?= $row[2] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
        `;
    }
    function contentHistory(){
        document.getElementById('content').innerHTML=`
        <h1>Riwayat Transaksi</h1>
        <table class="striped responsive-table">
            <tr>
                <th>No Rekening</th>
                <th>Nama</th>
                <th>Saldo</th>
            </tr>
            <?php
            $sql = "select * from history";
            $query = mysqli_query($koneksi,$sql);
            while($row= mysqli_fetch_array($query)){
            ?>
            <tr>
                <td width="15%"><?= $row[1] ?></td>
                <td width="20%"><?= $row[2] ?></td>
                <td width="60%">Rp.<?= $row[3] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
        `;

        
    }
    function contentMasterAkun(){
            document.getElementById('content').innerHTML=`
                <h1>Master Akun</h1>
                <form action="masterakun.php" method="post">
            <table class="responsive-table white">
                <tr>
                    <td>No Rekening</td>
                    <td>
                        <select class="btn" name="noreg" id="noreg">
                            <?php
                            $sql = "select * from akun order by nama ASC";
                            $query = mysqli_query($koneksi,$sql);
                            while($row = mysqli_fetch_array($query)){
                            ?>
                            <option value='<?= $row["id_akun"] ?>'><?php echo "$row[nama] - $row[id_akun]"; ?></option>
                            <?php } ?>
                        </select><label>Pilih no Rekening Nasabah</label>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input name="nama" placeholder="Masukan nama baru disini" type="text"></td>
                </tr>
                <tr>
                    <td><input name="perbarui" type="submit" value="Perbarui Akun" class="btn purple"></td>
                    <td><input name="delete" type="submit" value="Hapus Akun Permanen" class="btn red"></td>
                </tr>
            </table>
        </form>
            `;
        }

        function contentMasterUser(){
            document.getElementById('content').innerHTML=`
        <h1>Master User</h1>
        <table class="striped responsive-table white">
            <tr>
                <th>Username</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
            <?php
            $sql = "select * from user where level=0";
            $query = mysqli_query($koneksi,$sql);
            while($row= mysqli_fetch_array($query)){
            ?>
            <tr>
                <td width="20%"><?= $row[1] ?></td>
                <td width="5%"><?= $row[3] ?></td>
                <td width="20%"><a  href="masteruser.php?accept=<?= $row[0] ?>">Accept</a>
                <a  href="masteruser.php?deny=<?= $row[0] ?>">deny</a></td>
            </tr>
            <?php } ?>
        </table>
        </div>
        `;
        }

        function contentChange(){
            document.getElementById('content').innerHTML = `
                <h1>Ganti Password</h1>
                <form action="change.php" method="post">
                    <table class="striped responsive-table white">
                        <tr>
                            <td class="purple lighten-4">Password Saat ini</td>
                            <td><input type="password" name="oldpass"></td>
                        </tr>
                        <tr>
                            <td class="purple lighten-4">Password Baru</td>
                            <td><input type="password" name="newpass"></td>
                        </tr>
                        <tr>
                            <td class="purple lighten-4">Konfirmasi Password Baru</td>
                            <td><input type="password" name="konnewpass"></td>                            
                        </tr>
                        <tr>
                            <td><input type="submit" value="Simpan Perubahaan" name="change" class="btn"></td>
                        </tr>
                    </table>
                </form>
                `;
        }
    </script> 
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-2.1.1.min.js"
    ></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
      $(document).ready(function() {
        $(".dropdown-trigger").dropdown();
      });
    </script>  
    
</body>
</html>
