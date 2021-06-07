<?php
$title = "daftar pengembalian";
include '../header_admin.php';

//perpanjangan 
$perpanjangan = "SELECT * FROM perpanjangan INNER JOIN anggota ON perpanjangan.id_user = anggota.id INNER JOIN daftar_buku ON perpanjangan.id_buku = daftar_buku.id INNER JOIN buku ON daftar_buku.buku = buku.id";
$query_perpanjangan = $koneksi->query($perpanjangan);
?>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><img src="../../images/book.png" width="20"> Daftar Perpanjangan</b> </h5>
    </header>

    <div class="w3-row-padding w3-margin-bottom">
        <table class="w3-table">
            <tr>
                <th>NO</th>
                <th>Tag</th>
                <th>Judul</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Perpanjangan</th>

            </tr>
            <?php
            $no = 1;
            while ($row_perpanjangan = $query_perpanjangan->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row_perpanjangan['tag_buku']; ?></td>
                    <td><?php echo $row_perpanjangan['judul']; ?></td>
                    <td><?php echo $row_perpanjangan['nama']; ?></td>
                    <td><?php echo $row_perpanjangan['tanggal_perpanjangan']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
    include '../footer.php';
    ?>