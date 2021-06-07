<?php
$title = "daftarbuku";
include '../header_admin.php';
$id_buku = $_GET['id'];

    $daftar_buku = "SELECT * FROM daftar_buku INNER JOIN buku ON daftar_buku.buku = buku.id WHERE daftar_buku.buku = '$id_buku'";
    $query_buku = $koneksi->query($daftar_buku);
    $row = $query_buku->fetch_assoc();
    
    $daftar_buku2 = "SELECT * FROM daftar_buku WHERE buku = '$id_buku'";
    $query_buku2 = $koneksi->query($daftar_buku2);
    $row3 = $query_buku2->fetch_assoc();
    $list_book = $row3['id'];

   

    $peminjaman = "SELECT * FROM peminjaman INNER JOIN anggota ON peminjaman.id_user = anggota.id INNER JOIN daftar_buku ON peminjaman.id_buku = daftar_buku.id WHERE peminjaman.id_buku = '$list_book' ";
    $pinjam = $koneksi->query($peminjaman);
   
?>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
  <h5><b><img src="../../images/book.png" width="20"> Riwayat Peminjaman Buku</b> </h5>
  </header>
    <div class="w3-row-padding">
        <div class="w3-col m3"  style="background: white">
    
            <table>
                <tr>
                <td>Judul buku</td>
                <td><b><?php echo $row['judul'] ?> <b></td>
                </tr>
                <tr>
                <td>Penerbit</td>
                <td><b><?php echo $row['penerbit'] ?> <b></td>
                </tr>
                <tr>
                <td>Pengarang</td>
                <td><b><?php echo $row['pengarang'] ?> <b></td>
                </tr>
                <tr>
                <td>Tahun</td>
                <td><b><?php echo $row['tahun'] ?> <b></td>
                </tr>
            </table>
         </div>
        <div class="w3-col m6">
        <table class="w3-table w3-striped w3-border" style="background:grey">
    <tr>
      <th>Code buku</th>
      <th>Nama</th>
      <th>Tanggal Peminjaman</th>
      <th>Status</th>
    </tr>
    <?php
            while($row2 = $pinjam->fetch_assoc()) {              
    ?>
    <tr>
      <td><?php echo $row2['tag_buku']; ?></td>
      <td><?php echo $row2['nama']; ?></td>
      <td><?php echo $row2['tanggal_peminjaman']; ?></td>
      <td><?php echo $row2['kondisi']; ?></td>
    </tr>
   <?php } ?>
  </table>
         </div>
    </div>
  
  <?php
  include '../footer.php';
  ?>