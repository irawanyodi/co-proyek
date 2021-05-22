<?php 
// mulai session
session_start();
if (isset($_SESSION["ses_username"])) {
    header("location: ./customer/store/stores.php");
}
// koneksi db
include './inc/koneksi.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Captain Order | Landing Page</title>
  <link rel="stylesheet" href="dist/css/style.css">
</head> 
<body>
  <header class="header-index">
    <img src="./dist/img/brand/logo.png" alt="Logo Captain Order">
    <p>Penjelasan singkat tentang Captain Order</p>
  </header>
  <main>
    <div class="tutorial">
      <img src="./dist/img/brand/lp.png" alt="ilustrasi pemesanan">
    </div>
    <div class="kolom-tombol">
      <a href="./customer/user/login.php">login</a>
      <a href="./customer/user/register.php">sign up</a>
    </div>
  </main>
    <footer>
      <p>Copyright 2021 | by COTeam</p>
    </footer>
</body>
</html>