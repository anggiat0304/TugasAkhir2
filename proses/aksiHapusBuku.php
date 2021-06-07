<?php
    session_start();
    if (!($_SESSION['login'])) {
        header('location:../view/login.php');
    }
    include '../config/koneksi.php';
    $id = $_GET['id'];
  
    $peminjaman = "DELETE FROM peminjaman WHERE id_buku = $id";
    $pengembalian = "DELETE FROM pengembalian WHERE id_buku = $id";
    $perpanjangan = "DELETE FROM perpanjangan WHERE id_buku = $id";
    $sql = "DELETE FROM daftar_buku WHERE id = $id";
    $result2 = $koneksi->query($peminjaman);
    $result3 = $koneksi->query($pengembalian);
    $result4 = $koneksi->query($perpanjangan);
    $result = $koneksi->query($sql);
    if ($result === true) {
        echo "<script>
        window.history.go(-1); 
       </script>";
    }else {
        echo "<script>
        alert('gagal'); 
       </script>";
    }
?>
    
