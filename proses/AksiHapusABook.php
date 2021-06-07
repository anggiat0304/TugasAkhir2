<script type="text/javascript" src="../../../js/sweetalert2.all.min.js"></script>
<?php
    session_start();
    if (!($_SESSION['login'])) {
        header('location:../view/login.php');
    }
    include '../config/koneksi.php';
    $id = $_GET['id'];
  
    
    $perpanjangan = "DELETE FROM daftar_buku WHERE buku = $id";
    $sql = "DELETE FROM buku WHERE id = $id";

    $result4 = $koneksi->query($perpanjangan);
    $result = $koneksi->query($sql);
    if ($result === true) {
        echo "<script>
              window.location.href='../view/administrator/daftarbuku.php'; 
        </script>";
    }else {
        echo "<script>
        window.location.href='../view/administrator/daftarbuku.php'; 
       </script>";
    }
?>
    
