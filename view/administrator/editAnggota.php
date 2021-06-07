<?php
    $title = "editAnggota";
    include_once '../header_admin.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM anggota WHERE id = '$id'";
    $result = $koneksi->query($sql);
    $row = $result->fetch_assoc();
?>
   

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Edit Data Buku</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-quarter">
        <form class="w3-container" method="POST" >

        <label>TAG</label>
        <input class="w3-input" type="text" name="tag" value="<?php echo $row['tag'] ?>">

        <label>Judul</label>
        <input class="w3-input" type="text" name="nama" value="<?php echo $row['nama']; ?>">
        <label>Email</label>
        <input class="w3-input" type="text" name="email" value="<?php echo $row['email']; ?>">
        
        <label>Posisi</label>
        <input class="w3-input" type="text" name="posisi" value="<?php echo $row['rules']; ?>">
        
        <label>NIM / NIK</label>
        <input class="w3-input" type="text" name="nim" value="<?php echo $row['NIM']; ?>">
    
        <input type="submit" name="edit" value="edit" >
        </form>
    </div>
    </div>  
  </div>

  <?php
    include '../../config/koneksi.php';
    
    if (isset($_POST['edit'])) {
        $tag = $_POST['tag'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $posisi = $_POST['posisi'];
        $nim = $_POST['nim'];
        if ($posisi == 'admin') {
            $rules = 'admin';
        }else {
            $rules = 'user';
        }
        $sql = "UPDATE user SET tag = '$tag', nama= '$nama', email = '$email', posisi='$posisi',rules ='$rules'  WHERE id = $id";
        $result = $koneksi->query($sql);
        if ($result === true) {
            echo  "<script>
            if (confirm('Data Berhasil Diubah Tekan Tombol OK !')) {
                window.location.assign('daftaranggota.php');
            } else {
                window.history.back();
              }</script>";
        }
        }
?>
<?php
    include '../footer.php';
?>