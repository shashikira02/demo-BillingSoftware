<?php 
if(isset($_SESSION['email']))
{
  header('location: index.php');
  exit;
}

include 'connect.php';
require_once('./tcpdf/tcpdf.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/Development/PHPMailer/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/Development/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/Development/PHPMailer/PHPMailer-master/src/SMTP.php';


$email = new PHPMailer();
$email->SetFrom('shashikira4124@gmail.com', "Admin", FALSE); //Name is optional
$email->Subject   = 'Bill Book Verification Code';
$email->Body      =  "Your verification code is ".$code;
$email->AddAddress($_GET['email']);
$email->addReplyTo("noreply@email.com", "noreply@email.com");

if($email->Send())
{
    echo "<script>alert(\"Sent Code Successfully!\")</script>";
}
else
{
    echo "<script>alert(\"Failed to Send Code!\")</script>";
}


?>