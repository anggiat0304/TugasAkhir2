<?php 
    session_start();
    include '../config/koneksi.php';

    $id_buku = $_GET['id'];
    $date = date("Y-m-d");

    $peminjaman = "SELECT * FROM peminjaman WHERE id_buku = '$id_buku'";
    $query = $koneksi->query($peminjaman);
    $pinjam = $query->fetch_assoc();

    $id_user =  $pinjam['id_user'];

    $daftar_buku = "INSERT INTO pengembalian (tanggal_pengembalian, id_buku, id_user) VALUES ('$date','$id_buku','$id_user')";
    $update_buku = "UPDATE daftar_buku SET box_id = null ,kondisi = 'free'  WHERE id = '$id_buku'";

    $QUB = $koneksi->query($update_buku);
    $QDB = $koneksi->query($daftar_buku);

    if ($QUB == true && $QDB == true) {
        echo "<script>
        window.history.go(-1);
    </script>";
    }else {
        echo "<script>
       alert('gagal');
    </script>";
    echo "<script>
    window.history.go(-1);
</script>";
    }
?>
