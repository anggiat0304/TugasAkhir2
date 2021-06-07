<?php 
    // use PHPMailer\PHPMailer\PHPMailer;
    // require_once "PHPMailer/PHPMailer.php";
    // require_once "PHPMailer/SMTP.php";
    // require_once "PHPMailer/Exceptions.php";
    session_start();
    if (!isset($_SESSION['peminjaman'])) {
        echo "<script>alert('belum')</script>";
    }

    
    echo $id_buku;
?>