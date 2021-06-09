<?php
$title = "daftar peminjaman";
include '../header_admin.php';

//peminjaman

    $peminjaman = "SELECT *
    FROM peminjaman";
   
   $pinjam = $koneksi->query($peminjaman);
?>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><img src="../../images/book.png" width="20"> Daftar Keterlambatan</b> </h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
  <table class="w3-table">
<tr>
  <th>NO</th>
  <th>Tag</th>
  <th>Judul</th>
  <th>Nama Peminjam</th>
  <th>Keterlambatan</th>
  <th>Aksi</th>
</tr>
      
      <?php
      $no = 1;
      $date = date_create();
      
      while ($row = $pinjam->fetch_assoc()) {
          $book_id = $row['id_buku'];
          $id_peminjaman = $row['id'];
          $id_user = $row['id_user'];
          $expired = date_create($row['expired']);

          $daftar_buku ="SELECT * FROM daftar_buku INNER JOIN buku ON daftar_buku.buku = buku.id WHERE daftar_buku.id = '$book_id'";
          $anggota = "SELECT * FROM peminjaman INNER JOIN anggota WHERE peminjaman.id_user = anggota.id"; 


          $cekPeminjaman = "SELECT * FROM pengembalian WHERE id_peminjaman = '$id_peminjaman'";
          $QCP = $koneksi->query($cekPeminjaman);
          $row2= $QCP->fetch_assoc();
            if ($expired > $date  ) {
                echo "Tidak ada data";
            }else {
                $UDB = "UPDATE daftar_buku SET kondisi = 'late' WHERE id = '$book_id'";
                $QU = $koneksi->query($UDB);
                $selisih = date_diff($expired,$date);
                $QDB = $koneksi->query($daftar_buku);
                $QDA = $koneksi->query($anggota);
                if ($row2 == 0) {   
                    $FDB = $QDB->fetch_assoc();
                     $FDA = $QDA->fetch_assoc();
            ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $FDB['tag_buku'] ?></td>
          <td><?php echo $FDB['judul'] ?></td>
          <td><?php echo $FDA['nama'] ?></td>
          <td><?php echo $selisih->days ?> hari</td>
          <td><a href="../../proses/simpanLate.php?id=<?php echo $book_id ?>" style="text-decoration:none; color:blue;">Simpan</a></td>
        </tr>
        <?php
                }
        } 
        }?>
    </table>
  </div>
  <?php
  include '../footer.php';
  ?>