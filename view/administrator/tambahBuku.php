<?php
    $title = "tambahbuku";
    include_once '../header_admin.php'
?>
   

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Tambah Data Buku</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-quarter">
        <form class="w3-container" method="POST" action="../../proses/aksiTambahBuku.php">

        <label>Judul</label>
        <input class="w3-input" type="text" name="judul">
       
        
         <label>Penerbit</label>
        <input class="w3-input" type="text" name="penerbit">
       
        
         <label>Pengarang</label>
        <input class="w3-input" type="text" name="pengarang">
        
        

        <label>Tahun</label>
        <input class="w3-input" type="text" name="tahun">
        <input type="submit" value="tambah">

        </form>
    </div>
    </div>
    
  </div>
  
 
<?php
    include '../footer.php';
?>