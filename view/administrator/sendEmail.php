<?php
    use PHPMailer\PHPMailer\PHPMailer;
    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];
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

        $mail->setFrom('anggiatpangaribuan12@gmail.com','Anggiat');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
            $response = "mail sent";
        }else {
            $response ="something is wrong <br> <br>" . $mail->ErrorInfo;
        }
        exit(json_encode(array("response" =>$response)));
    }
?>