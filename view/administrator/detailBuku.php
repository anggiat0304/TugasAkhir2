<?php
  $title = "detail buku";
  include_once '../header_admin.php';
    $id = $_GET['id'];

    $sql = "SELECT * FROM daftar_buku WHERE daftar_buku.buku = '$id'";
    $result3 = $koneksi->query($sql);
    

    $sql2 = "SELECT * FROM buku WHERE id = '$id'";
    $result2 = $koneksi->query($sql2);
    $row3 = $result2->fetch_assoc();
    
 

    ?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i>Detail Data Buku</b></h5>
  </header>
  
  <div class="w3-row-padding w3-margin-bottom">
      
            <div class="w3-row-padding w3-margin-bottom">
               <div class="w3-col m6">
                <div style="background: white; padding: 10px;">
                    <table>
                    <tr>
                            <td>Judul Buku</td>
                            <td>:</td>
                            <td><b><?php echo $row3['judul'] ?></b></td>
                        </tr>
                        <tr>
                            <td>Pengarang Buku</td>
                            <td>:</td>
                            <td><b><?php echo $row3['pengarang'] ?></b></td>
                        </tr>
                        <tr>
                            <td>Penerbit Buku</td>
                            <td>:</td>
                            <td><b><?php echo $row3['penerbit'] ?></b></td>
                        </tr>
                        <tr>
                            <td>Tahun Terbit Buku</td>
                            <td>:</td>
                            <td><b><?php echo $row3['tahun'] ?></b></td>
                        </tr>
                    </table>

                    <form  method="POST" action="../../proses/tambahTagBuku.php">

                    
                    <input  type="text" name="tag">
                    <input  type="hidden" name="book" value="<?php echo $id; ?>">
                    <input type="submit" value="tambah">

                    </form>

                    <table>
                        <tr>
                        <td>
                            <a href="riwayatPeminjaman.php?id=<?php echo $row3['id']; ?>">
                                <button class="w3-btn w3-teal">
                                Lihat Riwayat Peminjaman
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="../../proses/AksiHapusABook.php?id=<?php echo $row3['id']; ?>">
                                <button class="w3-btn w3-red">
                                Hapus Buku
                                </button>
                            </a>
                        </td>
                        </tr>
                    </table>
                </div>
               </div>
               <div class="w3-col m6">
                <div style="background: white; padding: 10px;">
                          
                            <table >
                                <tr>
                                    <th>No</th>
                                    <th>Code Buku</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php 
                                $a=0;
                                while (  $row4 = $result3->fetch_assoc()) {
                                    $a = 1 + $a;
                            ?>
                              
                                      <tr>
                                            <td><?php echo $a;?></td>
                                            <td>
                                                <?php echo $row4['tag_buku']?>
                                            </td>
                                            <td>
                                                <?php echo $row4['kondisi']?>
                                            </td>
                                            <td>
                                            <a href="../../proses/aksiHapusBuku.php?id=<?php echo $row4['id'] ?>">
                                            <button class="w3-btn w3-red">
                                            Hapus
                                            </button>
                                            </a>
                                            </td>
                                      </tr>                                                
                            <?php }?>      
                            </table>
                                 
                            
                </div>
               </div>
            </div>
        
    </div>

