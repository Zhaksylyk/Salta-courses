<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    //SMTP Settings
    $mail->isSMTP();
    $mail->Host = "smartaccount.kz";
    $mail->SMTPAuth = true;
    $mail->Username = "info@smartaccount.kz"; //enter you email address
    $mail->Password = 'SmartAccount4492650'; //enter you email password
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress("info@smartaccount.kz"); //enter you email address
    $mail->Subject = ("$email ($subject)");
    $mail->Body = '<table width="90%" border="0">
    <tr>
    <td><b>Имя:</b></td> <td>' . $name . '</td>
    </tr>
    <tr>
    <td><b>Email:</b></td> <td>' . $email . '</td>
    </tr>
    <tr>
    <td><b>Телефон:</b></td> <td>' . $phone . '</td>
    </tr>
    <tr>
    <td><b>Тема:</b></td> <td>' . $subject . '</td>
    </tr>
    <tr>
    <td><b>Сообщения:</b></td> <td>' . $body . '</td>
    </tr>
    <tr></table>';

    if ($mail->send()) {
        $status = "success";
        $response = "Email is sent!";
    } else {
        $status = "failed";
        $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
}
