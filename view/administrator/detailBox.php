<?php
    $title = "home";
    include_once '../header_admin.php';
    $id_box = $_GET['id'];
    $kotak = "SELECT * FROM kotak WHERE id = '$id_box'";
    $KT = $koneksi->query($kotak);
    $ktk = $KT->fetch_assoc();
    $buku = "SELECT daftar_buku.id , buku.judul ,daftar_buku.tag_buku FROM daftar_buku INNER JOIN buku ON daftar_buku.buku = buku.id WHERE box_id = '$id_box'";
    $result = $koneksi->query($buku);    
?>
   

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Daftar buku di dalam dropbox <?php echo $ktk['no_box']?></b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <?php
        while ($row = $result->fetch_assoc()) {
      ?>
       <table class="w3-table">
                <tr>
                <th>Tag Buku</th>
                <th>Judul Buku</th>
                <th>Aksi</th>
                </tr>
                <tr>
                <td><?php echo $row['tag_buku'] ?></td>
                <td><?php echo $row['judul'] ?></td>
                <td><a href="../../proses/ubahStatusBuku.php?id=<?php echo $row['id']?>">
                <button class="w3-btn w3-green">
                    Simpan Buku
                </button></a></td>
                </tr>
                </table>
      <?php } ?>
    </div>
  </div>


 
<?php
    include '../footer.php';
?>
        