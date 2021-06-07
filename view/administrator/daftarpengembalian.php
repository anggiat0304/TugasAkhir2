<?php
$title = "daftar pengembalian";
include '../header_admin.php';

// pengembalian 
$pengembalian = "SELECT * FROM pengembalian INNER JOIN anggota ON pengembalian.id_user = anggota.id INNER JOIN daftar_buku ON pengembalian.id_buku = daftar_buku.id INNER JOIN buku ON daftar_buku.buku = buku.id";
$query_pengembalian = $koneksi->query($pengembalian);

?>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><img src="../../images/book.png" width="20"> Daftar Pengembalian</b> </h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <table class="w3-table">
      <tr>
        <th>NO</th>
        <th>Tag</th>
        <th>Judul</th>
        <th>Nama Peminjam</th>
        <th>Tanggal Pengembalian</th>

      </tr>
      <?php
      $no = 1;
      while ($row_pengembalian = $query_pengembalian->fetch_assoc()) {
      ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $row_pengembalian['tag_buku']; ?></td>
          <td><?php echo $row_pengembalian['judul']; ?></td>
          <td><?php echo $row_pengembalian['nama']; ?></td>
          <td><?php echo $row_pengembalian['tanggal_pengembalian']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <?php
  include '../footer.php';
  ?>