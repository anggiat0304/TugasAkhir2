<?php
    $title = "home";
    include_once '../header_admin.php';

    $kotak = "SELECT * FROM kotak";
    $result = $koneksi->query($kotak);

    
?>
   

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Daftar Dropbox</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <?php
      $sum = 0;
        while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $buku = "SELECT * FROM daftar_buku";
          $sql = $koneksi->query($buku);
          
         
      ?>
      <div class="w3-container w3-red w3-padding-16" style="margin-bottom:5px">
            <div class="w3-left"><img src="../../images/safe.png" width="80"></div>
                <div class="w3-right">
                    <h3><?php echo $row['no_box'] ?></h3>
                    <h3><?php 
                          $sum = 0;
                          while ($row2 = $sql->fetch_assoc()) {
                          if ($row2['box_id']==$id) {
                          $sum++;
                            }
                          
                        } echo $sum; ?></h3>
                    </div>
                <div class="w3-clear"></div>
                <h4><a href="detailBox.php?id=<?php echo $row['id']?>">Lihat box</a></h4>
      </div>
      <?php } ?>
    </div>
  </div>


 
<?php
    include '../footer.php';
?>
        