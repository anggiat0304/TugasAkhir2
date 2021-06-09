<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
}
include '../../config/koneksi.php';
?>

<!DOCTYPE html>
<html>
<title><?php echo $title ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/w3.css">
<link rel="stylesheet" href="../../css/fonts-w3.css">
<link rel="stylesheet" href="../../css/font-awesome.min.css">
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="TimeCircles/TimeCircles.js"></script>
<link rel="stylesheet" type="text/css" href="TimeCircles/TimeCircles.css">
<style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
        font-family: "Raleway", sans-serif
    }
</style>

<body class="w3-light-grey">

    <!-- Top container -->
    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><img src="../../images/menu.png" width=10 class="fa fa-bars">  Menu</button>
        <span class="w3-bar-item w3-right"><img src="../../images/online-library.png"  style="width:46px"></span>
    </div>

    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
        <div class="w3-container w3-row">
            <div class="w3-col s4">
                <img src="../../images/customer-support.png" class="w3-circle w3-margin-right" style="width:46px">
            </div>
            <div class="w3-col s8 w3-bar">
                <span>Welcome, <strong><?php echo $_SESSION['nama'] ?></strong></span><br>

            </div>
        </div>
        <hr>
        <div class="w3-container">
            <h5>Dashboard</h5>
        </div>
        <div class="w3-bar-block">
            <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
            <a href="home.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/locker.png" width=20></i>  Daftar Dropbox</a>
            <a href="daftarbuku.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/book.png" width="20">  Daftar Buku</a>
            <a href="daftaranggota.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/participant.png" width=20>  Daftar Anggota Perpustakaan</a>
            <a href="daftarpeminjaman.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/list.png" width=20>  Daftar Peminjaman</a>
            <a href="daftarpengembalian.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/return.png" width="20">  Daftar Pengembalian</a>
            <a href="daftarperpanjangan.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/link.png" width="20">  Daftar Perpanjangan</a>
            <a href="daftarketerlambatan.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/timer.png" width="20">  Daftar Kerlambatan</a>
            <a href="../logout.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/logout.png" width="20">  Logout</a>
        </div>
    </nav>