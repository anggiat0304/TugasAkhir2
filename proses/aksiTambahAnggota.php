<?php
    include '../config/koneksi.php';
    $tag = $_POST['tag'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $posisi = $_POST['posisi'];
    $nim = $_POST['nim'];
    if ($posisi == 'admin') {
        $rules = 'admin';
    }else {
        $rules = $posisi;
    }
    $sql = "INSERT INTO anggota (tag, nama, email,rules,NIM)
VALUES ('$tag', '$nama', '$email','$rules','$nim')";

    $anggota = "SELECT * FROM anggota";
    $result = $koneksi->query($anggota);
    $error =null;
    while ($row = $result->fetch_assoc()) {
       if ($tag == $row['tag']) {
        $error = 1;
       }
    }
    if ($error == 1) {
        header('location: ../view/administrator/tambahAnggota.php');
        echo "<script>alert('Tag telah digunakan')</script>";
        }else {
            $tambah = $koneksi->query($sql);
            header('location: ../view/administrator/daftaranggota.php');
    }
?>