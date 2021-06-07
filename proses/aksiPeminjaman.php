<script type="text/javascript" src="../../../js/sweetalert2.all.min.js"></script>
<?php
    
    include '../config/koneksi.php';
    
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    
    
    $tag = $_POST['peminjaman'];
    $user_id = $_POST['id_user'];
    $date = date("Y-m-d");


    $anggota = "SELECT * FROM anggota where id = '$user_id' ";
    $QA = $koneksi->query($anggota);
    $row = $QA->fetch_assoc();
    
    $buku = "SELECT * FROM daftar_buku WHERE tag_buku = '$tag'";
    $result2 = $koneksi->query($buku);
    $row2 = $result2->fetch_assoc();
    $book_id = $row2['id'];
    
    if ($row['rules'] == 'mahasiswa') {
        $tgl2 = date('Y-m-d', strtotime('+7 days', strtotime($date)));
        $max_books = 4;
    }else {
        $tgl2 = date('Y-m-d', strtotime('+14 days', strtotime($date)));
        $max_books = 10;
    }

    //insert peminjaman
    $peminjaman = "INSERT INTO peminjaman (tanggal_peminjaman, expired, id_buku,id_user) VALUES ('$date', '$tgl2', '$book_id','$user_id')";
    $UDB = "UPDATE daftar_buku SET kondisi = 'dipinjam' WHERE id = '$book_id'";
    if ($row2['tag_buku'] == $tag) {
        if ($row2['kondisi']=='free') {
          if ($max_books == true) {
            echo "<script>
            
            Swal.fire({
              title: 'Anda Sudah Mencapai batas peminjaman buku\n Transaksi Lagi?',
              showDenyButton: true,
              showCancelButton: true,
              confirmButtonText: `Save`,
              denyButtonText: `Logout`,
              
            }).then((result) => {
              Swal.fire('Saved!', '', 'success')
              if (result.isConfirmed) {
              } else if (result.isDenied) {
                window.location.href='../logout.php' 
              }
            })
            </script>";
          }else {
            $pinjam = $koneksi->query($peminjaman);
            $up = $koneksi->query($UDB);
            echo "<script>
       
                Swal.fire({
                  title: 'Anda Berhasil Melakukan Peminjaman\n Transaksi Lagi?',
                  showDenyButton: true,
                  showCancelButton: true,
                  confirmButtonText: `Save`,
                  denyButtonText: `Logout`,

                }).then((result) => {
                    Swal.fire('Saved!', '', 'success')
                  if (result.isConfirmed) {
                } else if (result.isDenied) {
                      window.location.href='../logout.php' 
                  }
                })
                </script>";
          }
    }else {
      echo "<script>
       
          Swal.fire(
            'Code Buku tidak terdaftar?',
            'Ingin mencoba lagi?',
            'question'
          )
          </script>";
    }
    ?> 