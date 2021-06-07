<?php
    session_start();
    if (!($_SESSION['login'])) {
        header('location:../view/login.php');
    }
    include '../config/koneksi.php';
    $id = $_GET['id'];
    echo $id;
    $sql = "DELETE FROM anggota WHERE id=$id";
    $sql2 = "DELETE FROM peminjaman WHERE id_user=$id";
    $sql3 = "DELETE FROM pengembalian WHERE id_user=$id";
    $sql4 = "DELETE FROM perpanjangan WHERE id_user=$id";
    $result4 = $koneksi->query($sql4);
    $result3 = $koneksi->query($sql3);
    $result2 = $koneksi->query($sql2);
    $result = $koneksi->query($sql);
    
    if ($result === true) {
        header('location: ../view/administrator/daftaranggota.php');
    }
?>