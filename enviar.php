<?php 

//include("conexion.php");

include("class.phpmailer.php");

//include("config.php");


if (isset ($_POST['Email'])){

$Email=$_POST['Email'];

$Email=explode(" ", $Email);

$Asunto=$_POST['Asunto'];

$Mensaje=$_POST['Mensaje'];



$cabeceras = "From: " . strip_tags($_POST['req-email']) . "\r\n";

$cabeceras .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";

$cabeceras .= "CC: yuri.valdez@uabc.edu.mx\r\n";

$cabeceras .= "MIME-Version: 1.0\r\n";

$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

$name = $_FILES['archivo']['name'];

$tmp_name = $_FILES['archivo']['tmp_name'];

$name1 = $_FILES['archivo1']['name'];

$tmp_name1 = $_FILES['archivo1']['tmp_name'];

$name2 = $_FILES['archivo2']['name'];

$tmp_name2 = $_FILES['archivo2']['tmp_name'];




foreach ($Email as $Emails){
 
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;
$mail->Debugoutput = "HTML";
$mail->Host = "mail.fcauabc.com";
$mail->Username = "Carlos@fcauabc.com"; 
$mail->Password = "blu3@T0p";
$mail->Port = 25;
//$mail->SMTPSecure = 'tls';
$mail->From = "Emprendedores@fcauabc.com";
$mail->FromName = "Emprendedores";
$mail->AddReplyTo("emprendedores.fcamxl@uabc.edu.mx", "Emprendedores");
$mail->IsHTML(true);
$mail->AddAttachment ($tmp_name, $name);
$mail->AddAttachment ($tmp_name1, $name1);
$mail->AddAttachment ($tmp_name2, $name2);
$mail->AddAddress($Emails);
$mail->Subject = $Asunto;
$mail->Body = nl2br($Mensaje);



if(!$mail->Send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
} 
else {
header("location:Enviado.php");

}

}

}
 
?>
