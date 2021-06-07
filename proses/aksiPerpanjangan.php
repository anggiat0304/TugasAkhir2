<?php

include '../config/koneksi.php';

session_start();

use PHPMailer\PHPMailer\PHPMailer;


$peminjaman = $_POST['perpanjangan'];
$user_id = $_POST['id_user'];
$date = date("Y-m-d");

$sql = "SELECT * FROM user WHERE id = $user_id";
$result1 = $koneksi->query($sql);
$row1 = $result1->fetch_assoc();
$status = $row1['posisi'];
if ($status == 'mahasiswa') {
    $tgl2 = date('Y-m-d', strtotime('+4 days', strtotime($date)));
} else if ($status == 'dosen') {
    $tgl2 = date('Y-m-d', strtotime('+7 days', strtotime($date)));
}

$sql2 = "SELECT * FROM buku WHERE tag = '$peminjaman'";
$sql3 = "UPDATE buku SET user_id = '$user_id' ,cek = 'diperpanjang' , expired = '$tgl2' WHERE tag = $peminjaman";
$result2 = $koneksi->query($sql2);
$row2 = $result2->fetch_assoc();
$email = $row1['email'];
$judul = $row2['judul'];
$tag = $row2['tag'];
$cek = $row2['cek'];
$body = "Anda baru saja memperpanjang buku yang berjudul : '$judul'sampai pada tanggal '$tgl2'";
if ($tag == $peminjaman) {
    if ($cek == 'free') {
        $result3 = $koneksi->query($sql3);
        if ($result3 === true) {

            require_once 'PHPMailer/PHPMailer.php';
            require_once 'PHPMailer/SMTP.php';
            require_once 'PHPMailer/Exception.php';

            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "anggiatpangaribuan12@gmail.com";
            $mail->Password = "sitoluama2";
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";

            $mail->setFrom('anggiatpangaribuan12@gmail.com', 'Anggiat');
            $mail->addAddress($email);
            $mail->Subject = 'Peminjaman Buku';
            $mail->Body = $body;

            if ($mail->send()) {
                $response = "OK Buku Telah Diperpanjang dan Telah Terkirim ke EMail anda";
            } else {
                $response = "something is wrong <br> <br>" . $mail->ErrorInfo;
            }
        } else {
            $response = "buku gagal dipinjam";
        }
    }
    if ($cek == 'diperpanjang') {
        $response = "buku telah diperpanjang limit perpanjangan hanya sekali";
    }
} else {
    $response = "tidak ada buku";
}
exit(json_encode(array("response" => $response)));
