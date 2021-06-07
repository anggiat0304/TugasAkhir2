<?php
  session_start();
  if(!isset($_SESSION['login'])){
    header('Location: ../login.php');
  }
  include '../../config/koneksi.php';

  $id_user = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<title><?php echo $title ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/w3.css">
<link rel="stylesheet" href="../../css/fonts-w3.css"> 
<link rel="stylesheet" href="../../css/font-awesome.min.css">
<script type="text/javascript" src="../../js/script.js"></script>
<script  type="text/javascript" src="../../js/bootstrap.js"></script>
<script  type="text/javascript" src="../../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/sweetalert2.all.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
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
    <a href="home.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/view.png" width="20"> Overview</a>
    <a href="peminjaman.php?id=<?php echo $id_user ?>" class="w3-bar-item w3-button w3-padding"><img src="../../images/list.png" width=20>  Peminjaman</a>
    <a href="pengembalian.php?id=<?php echo $id_user ?>" class="w3-bar-item w3-button w3-padding"><img src="../../images/return.png" width=20>  Pengembalian</a>
    <a href="perpanjangan.php?id=<?php echo $id_user ?>" class="w3-bar-item w3-button w3-padding"><img src="../../images/link.png" width=20>  Perpanjangan</a>
    <a href="../logout.php" class="w3-bar-item w3-button w3-padding"><img src="../../images/logout.png" width=20>  Logout</a>
   
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

 


  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
