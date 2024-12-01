<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

$digito1 = rand(0,9);
$digito2 = rand(0,9);
$digito3 = rand(0,9);
$codigo = strval($digito1.$digito2.$digito3);
setcookie('codigoCorreo', $codigo, time() + 300, "/");

try {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    $email = "plataformauta2023@gmail.com";
    $pass = "bzhl ebqq trwp qdni";
    $para = $_POST["email"];
    $htmlContent = file_get_contents('../util/modalemail.html');

    $htmlContent = str_replace('<span id="digit-1"></span>', $digito1, $htmlContent);
    $htmlContent = str_replace('<span id="digit-2"></span>', $digito2, $htmlContent);
    $htmlContent = str_replace('<span id="digit-3"></span>', $digito3, $htmlContent);
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $email; 
    $mail->Password = $pass;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($email, 'AUTORENT');
    $mail->addAddress($para);

    $mail->Subject = 'Codigo de seguridad';
    $mail->msgHTML($htmlContent);

    $mail->send();
    echo json_encode(array('error' => false, 'message' => 'Correo enviado','digito1'=>$digito1,'digito2'=>$digito2,'digito3'=>$digito3));
} catch (Exception $e) {
    echo json_encode(array('error' => true, 'message' => 'Error al enviar: ' . $mail->ErrorInfo));
}
?>