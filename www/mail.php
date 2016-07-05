<?php
require 'PHPMailer_5.2.4/class.phpmailer.php';
$email = new PHPMailer();
$email->From      = 'sdjoyson@gmail.com.com';
$email->FromName  = 'joyson';
$email->Subject   = 'Message Subject';
$email->Body      = 'asdfasfasfdaasdf';
$email->AddAddress( 'sdjoyson1@gmail.com' );

$file_to_attach = 'PATH_OF_YOUR_FILE_HERE';

$email->AddAttachment( $file_to_attach , 'NameOfFile.pdf' );

return $email->Send();

?>