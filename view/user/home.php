
<?php
    $title="peminjaman buku";

    include '../header_user.php';
       
?>
 
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-center" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <div class="w3-row-padding w3-col m4 w3-margin-bottom">
    <div class="w3-card-4 ">
      <div class="w3-container w3-blue">
        <h2>Peminjaman</h2>
      </div>
    <form class="w3-container" style="padding:10px;" method="POST" >
        <label>TAG BUKU</label>
        <input  type="text"  class="w3-input"  name="peminjaman">
        <input type="hidden" name="id_user"  value="<?php echo $_SESSION['id'] ?>">
    </form>
    </div>
  </div>
  <div class="w3-row-padding w3-col m4 w3-margin-bottom">
    <div class="w3-card-4 ">
      <div class="w3-container w3-teal">
        <h2>Pengembalian</h2>
      </div>
    <form class="w3-container" style="padding:10px;" method="POST">
        <label>TAG BUKU</label>
        <input class="w3-input" type="text"  name="pengembalian" >
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id'] ?>">
    </form>
    </div>
  </div>
  <div class="w3-row-padding w3-col m4 w3-margin-bottom">
    <div class="w3-card-4 ">
      <div class="w3-container w3-yellow">
        <h2>Perpanjangan</h2>
      </div>
    <form class="w3-container" style="padding:10px;" method="POST">
        <label>TAG BUKU</label>
        <input class="w3-input" type="text" name="perpanjangan">
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id'] ?>">
    </form>
    </div>
  </div>
  
 <?php
    include '../footer.php';

    if (isset($_POST['peminjaman'])) {
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
      }else {
          $tgl2 = date('Y-m-d', strtotime('+14 days', strtotime($date)));
      }
  
      //insert peminjaman
      $peminjaman = "INSERT INTO peminjaman (tanggal_peminjaman, expired, id_buku,id_user) VALUES ('$date', '$tgl2', '$book_id','$user_id')";
      $UDB = "UPDATE daftar_buku SET kondisi = 'dipinjam' , jlh_perpanjangan = 0 WHERE id = '$book_id'";
      if ($row2['tag_buku'] == $tag) {
          if ($row2['kondisi']=='free') {
              $pinjam = $koneksi->query($peminjaman);
              $up = $koneksi->query($UDB);
              if ($pinjam === true && $up === true) {
                  echo "<script>
                  
                        Swal.fire({
                          title: 'Peminjaman berhasil. Apakah anda ingin melakukan transaksi lagi?',
                          showDenyButton: true,
                          confirmButtonText: `Ya`,
                          denyButtonText: `Tidak, terima kasih`,
                        }).then((result) => {
                          /* Read more about isConfirmed, isDenied below */
                          if (result.isConfirmed) {
                            
                          } else if (result.isDenied) {
                            window.location.href='../logout.php'
                          }
                        });
                  </script>";
              }
          }else {
            echo "<script>
                  
                        Swal.fire({
                          title: 'Status telah dipinjam.',
                          showDenyButton: true,
                          confirmButtonText: `Ya`,
                          denyButtonText: `Tidak, terima kasih`,
                        }).then((result) => {
                          /* Read more about isConfirmed, isDenied below */
                          if (result.isConfirmed) {
                            
                          } else if (result.isDenied) {
                            window.location.href='../logout.php'
                          }
                        });
                  </script>";
          } 
      }else {
        echo "<script>
         
            Swal.fire(
              'Code Buku tidak terdaftar',
              'Silahkan coba lagi',
              'question'
            )
            </script>";
      }
     
  }elseif (isset($_POST['pengembalian'])) {
    $tag = $_POST['pengembalian'];
    $user_id = $_POST['id_user'];
    $date = date("Y-m-d");


    $anggota = "SELECT * FROM anggota where id = '$user_id' ";
    $QA = $koneksi->query($anggota);
    $row = $QA->fetch_assoc();
    
    $buku = "SELECT * FROM daftar_buku WHERE tag_buku = '$tag'";
    $result2 = $koneksi->query($buku);
    $row2 = $result2->fetch_assoc();
    $book_id = $row2['id'];

    $peminjaman = "SELECT * FROM peminjaman WHERE id_buku = '$tag'";
    $result3 = $koneksi->query($peminjaman);
    $row3 = $result3->fetch_assoc();

    if ($date > $row3['expired']) {
      $error = true;
      $kondisi = 'late';
    }else{
      $kondisi = 'free';
    }
    //insert peminjaman
    
    $pengembalian = "INSERT INTO pengembalian (tanggal_pengembalian,id_buku,id_user) VALUES ('$date', '$book_id','$user_id')";
    $UDB = "UPDATE daftar_buku SET kondisi = '$kondisi' , jlh_perpanjangan = 0 WHERE id = '$book_id'";
    
    
    if ($row2['tag_buku'] == $tag) {
        if ($row2['kondisi']!='free') {
          if ($error == true) {
            $up = $koneksi->query($UDB);
            echo "<script>
            Swal.fire({
              title: 'Status anda telah terlambat. Silahkan hubungi petugas perpustakaan Transaksi Lagi?',
              showDenyButton: true,
              confirmButtonText: `Ya`,
              denyButtonText: `Tidak, Terima kasih`,

            }).then((result) => {
               
              if (result.isConfirmed) {
            } else if (result.isDenied) {
                  window.location.href='../logout.php' 
              }
            })
            </script>";
          }else{
            $pinjam = $koneksi->query($pengembalian);
            $up = $koneksi->query($UDB);
           
            if ($pinjam == true && $up == true) {
                echo "<script>
       
                Swal.fire({
                  title: 'Anda Berhasil Melakukan Pengembalian Transaksi Lagi?',
                  showDenyButton: true,
                  confirmButtonText: `Ya`,
                  denyButtonText: `Tidak, Terima kasih`,

                }).then((result) => {
                   
                  if (result.isConfirmed) {
                } else if (result.isDenied) {
                      window.location.href='../logout.php' 
                  }
                })
                </script>";
            }
          }
        }else {
          echo "<script>
                  
          Swal.fire({
            title: 'Status telah dikembalikan.',
            showDenyButton: true,
            confirmButtonText: `Ya`,
            denyButtonText: `Tidak, terima kasih`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              
            } else if (result.isDenied) {
              window.location.href='../logout.php'
            }
          });
    </script>";
        } 
    }else {
      echo "<script>
       
          Swal.fire(
            'Code Buku tidak terdaftar',
            'Silahkan coba lagi',
            'question'
          )
          </script>";
    }
  }
  elseif (isset($_POST['perpanjangan'])) {
    $tag = $_POST['perpanjangan'];
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
    }else {
      $tgl2 = date('Y-m-d', strtotime('+14 days', strtotime($date)));
    }

    if ($row2['jlh_perpanjangan'] >= 3) {
      echo "<script>
       
      Swal.fire({
        title: 'Perpanjangan sudah mencapai batas. Ingin melakukan transaksi lagi?',
        showDenyButton: true,
        confirmButtonText: `ya`,
        denyButtonText: `Tidak, terima kasih.`,

      }).then((result) => {
         
        if (result.isConfirmed) {
      } else if (result.isDenied) {
            window.location.href='../logout.php' 
        }
      })
      </script>";
    }else{
    $perpanjangan = "INSERT INTO perpanjangan (tanggal_perpanjangan,id_buku,id_user) VALUES ('$date', '$book_id','$user_id')";
    $UDB = "UPDATE daftar_buku SET kondisi = 'diperpanjang', jlh_perpanjangan = jlh_perpanjangan + 1 WHERE id = '$book_id'";
    
    $exp = "UPDATE peminjaman SET expired = '$tgl2' WHERE id_buku = '$book_id'";
    if ($row2['tag_buku'] == $tag) {
        if ($row2['kondisi']!='free') {
          $pinjam = $koneksi->query($perpanjangan);
          $up = $koneksi->query($UDB);
          $Uexpp = $koneksi->query($exp);
            if ($pinjam == true && $up == true) {
                echo "<script>
       
                Swal.fire({
                  title: 'Anda Berhasil Melakukan Perpanjangan Transaksi Lagi?',
                  showDenyButton: true,
                  confirmButtonText: `ya`,
                  denyButtonText: `Tidak, terima kasih.`,

                }).then((result) => {
                   
                  if (result.isConfirmed) {
                } else if (result.isDenied) {
                      window.location.href='../logout.php' 
                  }
                })
                </script>";
            }
        }else {
          echo "<script>
                  
          Swal.fire({
            title: 'Status buku telah dikembalikan.',
            showDenyButton: true,
            confirmButtonText: `Ya`,
            denyButtonText: `Tidak, terima kasih`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              
            } else if (result.isDenied) {
              window.location.href='../logout.php'
            }
          });
    </script>";
        } 
    }else {
      echo "<script>
       
          Swal.fire(
            'Code Buku tidak terdaftar',
            'Silahkan coba lagi',
            'question'
          )
          </script>";
    }
    }
  }
?>

    