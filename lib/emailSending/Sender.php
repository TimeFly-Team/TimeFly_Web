<?php

require_once(dirname(__FILE__)."/../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php");

class Sender
{
    public function send($to, $message, $from)
    {
      	$mail = $this->setMail();
       	$mail->setFrom('sktimefly@gmail.com', $from);
		$mail->AddAddress($to);
		$mail->Body = $message;
		return $this->tryToSend($mail);
    }

    private function setMail()
    {
		$mail = new PHPMailer;
		$mail->IsSMTP(); 
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;  
		$mail->Username = "sktimefly@gmail.com";      
		$mail->Password = "timefly12345";               
		$mail->SMTPSecure = 'tls';  
		$mail->Port = 587;
		$mail->Subject = "TimeFly answer";
		return $mail; 
    }

    private function tryToSend($mail)
    {
		if(!$mail->Send()) 
		{
		   echo 'Message was not sent.';
		   echo 'Mailer error: ' . $mail->ErrorInfo;
		   return false;
		}
		return true;
	}
}

?>