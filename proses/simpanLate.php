
<?php
    
    include '../config/koneksi.php';
    
    session_start();
    $id_buku =  $_GET['id'];
    $date = date("Y-m-d");
    $daftar_buku = "SELECT * FROM peminjaman WHERE peminjaman.id_buku='$id_buku' ";
    $result = $koneksi->query($daftar_buku);
    $row = $result->fetch_assoc();

    $id_peminjaman = $row['id'];

    $id_user = $row['id_user'];
    //ubah status buku
    
    $UDB = "UPDATE daftar_buku SET kondisi = 'free' ,jlh_perpanjangan = 0 WHERE id = '$id_buku'";
    $QU = $koneksi->query($UDB);
    
    if ($QU == true) {
        $pengembalian = "INSERT INTO pengembalian (tanggal_pengembalian,id_buku,id_user,id_peminjaman) VALUES ('$date', '$id_buku','$id_user','$id_peminjaman')";
        $QDP = $koneksi->query($pengembalian);
        echo "<script>window.history.go(-1);</script>";
    }
    ?> 