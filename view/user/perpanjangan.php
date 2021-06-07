<?php
  session_start();
  if(!isset($_SESSION['login'])){
    header('Location: ../login.php');
  }

  $title = "data perpanjangan user";
  include '../header_user.php';
  $id_user = $_GET['id'];
  
  $perpanjangan = "SELECT * FROM perpanjangan INNER JOIN daftar_buku ON  perpanjangan.id_buku = daftar_buku.id INNER JOIN buku ON daftar_buku.buku = buku.id WHERE id_user = '$id_user'";
  $QP = $koneksi->query($perpanjangan); 
?>

<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-center" style="margin-left:300px;margin-top:43px;">
<h1>History perpanjangan</h1>
<table class="w3-table">
<tr>
  <th>Code Buku</th>
  <th>Judul Buku</th>
  <th>Tanggal Perpanjangan</th>
</tr>
<?php while ($row = $QP->fetch_assoc()) { ?>
<tr>
  <td><?php echo $row['tag_buku'] ?></td>  
  <td><?php echo $row['judul'] ?></td>  
  <td><?php echo $row['tanggal_perpanjangan'] ?></td>  
</tr>
<?php } ?>

</table>
</div>

<?php include '../footer.php' ?>