<?php
    include '../config/koneksi.php';
       
        $judul = $_POST['judul'];
        $tahun = $_POST['tahun'];
        $penerbit = $_POST['penerbit'];
        $pengarang = $_POST['pengarang'];       
        $sql = "INSERT INTO buku (judul,pengarang,penerbit,tahun) VALUES ('$judul','$pengarang','$penerbit','$tahun')";
        $result = $koneksi->query($sql);
        if ($result === true) {
            header("location: ../view/administrator/daftarbuku.php");
        }
?>