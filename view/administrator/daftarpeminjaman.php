<?php
$title = "daftar peminjaman";
include '../header_admin.php';

//peminjaman

    $peminjaman = "SELECT * FROM peminjaman INNER JOIN anggota ON peminjaman.id_user = anggota.id INNER JOIN daftar_buku ON peminjaman.id_buku = daftar_buku.id INNER JOIN buku ON daftar_buku.buku = buku.id";
    $pinjam = $koneksi->query($peminjaman);

    // $book = "SELECT * FROM daftar_buku INNER JOIN buku ON daftar_buku.buku = buku.id";
    
?>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><img src="../../images/book.png" width="20"> Daftar Peminjaman</b> </h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <table class="w3-table">
      <tr>
        <th>NO</th>
        <th>Tag</th>
        <th>Judul</th>
        <th>Nama Peminjam</th>
        <th>Tanggal Peminjaman</th>
        <th>Batas Pengembalian</th>

      </tr>
      <?php
      $no = 1;
      while ($row = $pinjam->fetch_assoc()) {

      ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $row['tag_buku'] ?></td>
          <td><?php echo $row['judul'] ?></td>
          <td><?php echo $row['nama'] ?></td>
          <td><?php echo $row['tanggal_peminjaman'] ?></td>
          <td><?php echo $row['expired'] ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <?php
  include '../footer.php';
  ?>