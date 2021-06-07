<?php
    session_start();
    include '../config/koneksi.php';

    $tag = $_POST['tag'];
    $msg = '';
      
      $sql = "SELECT * FROM anggota WHERE tag = $tag";
      $result = $koneksi->query($sql);
      
    $row = $result->fetch_assoc();
    if ($row['tag'] == $tag) {
        if ($row['rules']=="admin") {
            $_SESSION['login']= true;
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['id']= $row['id'];
            echo 1;
        }if ($row['rules']!="admin") {
            $_SESSION['login']= true;
            $_SESSION['nama']= $row['nama'];
            $_SESSION['id']= $row['id'];
            echo 2;
        }
    }else {
            echo 3;
    }
      
?> 