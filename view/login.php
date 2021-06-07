<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/w3.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/script.js"></script>
    <script  type="text/javascript" src="../js/bootstrap.js"></script>
    <script  type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>
    <title>Login</title>
    <script>
    $(document).ready(function () {
      $("input").keyup(function () { 
        var tag = $("input").val();
        if (tag.length >= 10) {
            $.post("../proses/aksiLogin.php",{
          tag: tag
        }, function (data , status) {
             if (data == 1) {
              window.location = "administrator/home.php";
             }else if(data==2)  {
              window.location = "user/home.php";
             }else if(data==3){
              Swal.fire({
                          title: 'Kesalahan saat login. Silahkan hubungin admin.',
                          confirmButtonText: `Ok`,
                        }).then((result) => {
                          /* Read more about isConfirmed, isDenied below */
                          if (result.isConfirmed) {
                            window.history.go(0);
                          }
                        });
             }

        });
        }
      })
    });
    </script>
</head>
<body>
<form action="#" method="POST" id="frm">
    <fieldset id="fld">
        <legend>Login</legend>
        <label for="email"></label>
        <input type="text" size="30" name="tag" placeholder="Masukkan Barcode" maxlength="30" required><br><br>
    </fieldset>
</form>
</body>
</html>
