<?php
    include '../config/koneksi.php';  
        $tag = $_POST['tag'];
        $book = $_POST['book'];     
        
        $buku = "SELECT * FROM daftar_buku";
        $query = $koneksi->query($buku);
        while ($row = $query->fetch_assoc()) {
            if ($tag == $row['tag_buku']) {
                $error = true;
            }
        }
        if ($error == true) {
            echo "<script>
                alert('tag telah digunakan');
            window.history.go(-1)</script>";
        }else{
        $sql = "INSERT INTO daftar_buku (tag_buku,buku,kondisi) VALUES ( '$tag','$book','free')";
        $result = $koneksi->query($sql);
        if ($result === true) {
        
?>
     <script>
         window.history.go(-1); 
    </script>
<?php }} ?>