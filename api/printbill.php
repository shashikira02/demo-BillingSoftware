<?php

session_start();
  include 'connect.php';
  if (!isset($_SESSION['email'])) {
    header('location: login.php');
  }
?>
<?php
  include 'sendMailProductShortage.php';

  if(strlen($_SESSION['cust_email'])==0)
  {
    header("location:createbill.php");
    exit;
  }
	include 'savepdf.php';

	

	header("Content-type:application/pdf");
	// header("Content-Disposition:attachment;filename='pdf.pdf'");

	echo $content;

  include 'sendMailProductShortage.php';


?>