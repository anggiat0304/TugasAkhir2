<?php
    
    include '../config/koneksi.php';
    
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    

    $tag_buku = $_POST['pengembalian'];
    $user_id = $_POST['id_user'];
    $date = date("Y-m-d");
    $tgl2 = date('Y-m-d', strtotime('+6 days', strtotime($date)));
     
    //anggota
    $anggota = "SELECT * FROM anggota WHERE anggota.id = '$user_id'";
    $query_anggota = $koneksi->query($anggota);
    $row_anggota = $query_anggota->fetch_assoc();
    
    //select buku
    $buku = "SELECT * FROM buku  WHERE tag_buku = '$tag_buku'";
    $query_buku = $koneksi->query($buku);
    $row_buku = $query_buku->fetch_assoc();
    $id_buku = $row_buku['id'];

    //update buku 
    $update_buku = "UPDATE buku set kondisi = 'free' WHERE id = '$id_buku'";
    // pengembalian 
    $pengembalian = "INSERT INTO pengembalian (tanggal_pengembalian, id_buku, id_user) VALUES ('$date', '$id_buku', '$user_id')";
    
   
    //update peminjaman
    $update_peminjaman = "UPDATE peminjaman set expired = '$date' WHERE id_buku = '$id_buku'";
    if ($row_buku['tag_buku'] == $tag_buku) {
        if ($row_buku['kondisi'] != 'free') {
            $query_pengembalian = $koneksi->query($pengembalian);
            $query_update_peminjaman = $koneksi->query($update_peminjaman);
        if ($query_pengembalian == true) {
            $query_update_buku = $koneksi->query($update_buku);
            $response = "Buku Berhasil Dikembalikan";
        }
        }else {
            $response = "buku telah dikembalikan";
        }
    }else {
        $response = "Tag buku tidak tepat coba lagi"; 
    }
    exit(json_encode(array("response" =>$response)));
    ?> 