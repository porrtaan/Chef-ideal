<?php
include 'connect.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$email = $_POST['email'];

$sql = "SELECT * from utilizador where email = '$email'"; 
$result = mysqli_query($cn,$sql); 

$row = mysqli_fetch_array($result);

$nome = $row['nome'];
$codigo = $row['codigo'];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'melo.joaov@gmail.com';                     //SMTP username
    $mail->Password   = 'wrzicdqhirifxqjp';                               //SMTP password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('melo.joaov@gmail.com', 'Chef ideal');
    $mail->addAddress($email, $nome);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recuperação de password';
    $mail->Body = '<h3>Codigo de recuperação :</h3>'
    . $codigo;

    $mail->send();

      // Redireciona para outra página após o envio bem-sucedido do email
      header('Location: validar_rec.php');
      exit(); // Certifique-se de sair do script após o redirecionamento
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>