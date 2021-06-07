<?php 
    $title = "daftarbuku";
    include '../header_admin.php';
    $sql = "SELECT * FROM buku";
    $result = $koneksi->query($sql);
?>
   <!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><img src="../../images/book.png" width="20"> Daftar Buku</b> <a href="tambahBuku.php"><button>Tambah</button> </a></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
  <table class="w3-table">
<tr>
  <th>NO</th>
  <th>Judul</th>
  <th>Pengarang</th>
  <th>Penerbit</th>
  <th>Tahun</th>
  <th></th>
</tr>
<?php
    $no = 1;
    while ($row = $result->fetch_assoc()) {
?>
       <tr>
       <td><?php echo $no++; ?></td>
       <td><?php echo $row['judul']; ?></td>
       <td><?php echo $row['pengarang']; ?></td>
       <td><?php echo $row['penerbit']; ?></td>
       <td><?php echo $row['tahun']; ?></td>
       <td>
       <a href="detailBuku.php?id=<?php echo $row['id']; ?>"><button>Detail</button></a>
       </td>
       </tr> 
<?php }?>
</table>
  </div>
<?php 
    include '../footer.php';
?>