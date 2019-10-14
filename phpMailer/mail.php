<?php
session_start();
//header('Access-Control-Allow-Origin: *');                     
date_default_timezone_set("America/Sao_Paulo");


if (isset($_POST['mail'])) {
	
	$email = $_POST['mail'];
	print $email;
	
	require 'PHPMailerAutoload.php';
	require 'index.php';

	$mail = new PHPMailer;                              

	$mail->CharSet = 'UTF-8';
	$mail->IsSMTP();
	// $mail->Host = 'smtp.gmail.com';                 
	// $mail->Host = 'smtp.live.com';                 
	$mail->Host = '10.0.0.143';                 
	$mail->SMTPAuth = true;                            
	// $mail->Username = 'robertoenricon@gmail.com';              
	$mail->Username = 'robertoenrico_@hotmail.com.br';              
	$mail->Password = $pass;                       
	
	$mail->SMTPSecure = 'tls';                          
	$mail->Port = 587;
	
	// $mail->SMTPSecure = 'ssl'; //google                          
	// $mail->Port = 465; //google
	
	$mail->SMTPDebug = 0; //Desativa a depuração, sendo a opção padrão.
	// $mail->SMTPDebug = 1; //Exibe mensagens retornadas pelo cliente
	// $mail->SMTPDebug = 2; //Exibe mensagens do cliente e servidor
	// $mail->SMTPDebug = 4; //Exibe todas as mensagens, incluindo detalhes da comunicação

	// $mail->setFrom('robertoenricon@gmail.com', 'Sistema do Beto'); //Remetente
	$mail->setFrom('robertoenrico_@hotmail.com.br', 'Sistema do Beto'); //Remetente

	$mail->AddAddress($email); //Destinatarios

	$mail->isHTML(true); //Define que o e-mail será enviado como HTML

	$html = 'Corpo do email';

	$mail->Subject = 'Solicitação de Update de senha - ' . $email;
	$mail->Body    = $html;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if($mail->send()) {
		print "<br>Enviado";
	} else {
		print '<br>Erro ao enviar o e-mail: <br>';
		print 'Mailer Error: ' . $mail->ErrorInfo;
	}
}
