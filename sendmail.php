<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
  }

include 'savepdf.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/bill/PHPMailer/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/bill/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/bill/PHPMailer/PHPMailer-master/src/SMTP.php';


$email = new PHPMailer();
$email->SetFrom('shashikira4124@gmail.com', $_SESSION['name'], FALSE); //Name is optional
$email->Subject   = 'Your Bill';
$email->Body      = 'Find the attachment';
$email->AddAddress($_SESSION['cust_email']);
$email->addReplyTo($_SESSION['email'], $_SESSION['name']);


$filename = ($_SESSION['name'])."-bill.pdf";
$encoding = 'base64';
$type = 'application/pdf';

    //using PHPMailer
$email->AddStringAttachment($content,$filename,$encoding,$type);
if($email->Send())
{
    echo "Success";
}
else
{
    echo "Failed";
}

?>