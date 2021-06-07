<?php
    $title = "editBuku";
    include_once '../header_admin.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM buku WHERE id = '$id'";
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
        <input class="w3-input" type="text" name="tag" value="<?php echo $row['tag_buku'] ?>">

        <label>Judul</label>
        <input class="w3-input" type="text" name="judul" value="<?php echo $row['judul']; ?>">
        <input type="submit" name="edit" value="edit">
        </form>
    </div>
    </div>  
  </div>

  <?php
    include '../../config/koneksi.php';
    
    if (isset($_POST['edit'])) {
             $id = $_GET['id']; 
            $tag = $_POST['tag'];
            $judul = $_POST['judul'];
            $sql = "UPDATE buku SET tag = '$tag', judul= '$judul' WHERE id = $id";
        $result = $koneksi->query($sql);
        if ($result === true) {
            $msg = "<div class='w3-panel w3-green'>
            <h3>Success!</h3>
            <p>Data Berhasil Diubah.</p>
            <a href='daftarbuku.php'><button class='w3-btn'>Lihat Daftar Buku</button></a>
          </div> " ;
            // echo "<script>alert('Data Berhasil Diubah'); </script>"; 
            // header("location:daftarbuku.php");
            echo  "<script>
            if (confirm('Data Berhasil Diubah Tekan Tombol OK !')) {
                window.location.assign('daftarbuku.php');
            } else {
                window.history.back();
              }</script>";
        }
        }
?>
<?php
    include '../footer.php';
?>