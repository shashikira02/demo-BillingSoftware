<?php 
// session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
  }

include 'connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/Development/PHPMailer/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/Development/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/Development/PHPMailer/PHPMailer-master/src/SMTP.php';


$email = new PHPMailer();
$email->SetFrom('shashikira4124@gmail.com', "Admin", FALSE); //Name is optional
$email->Subject   = 'Your Products Shortage';
$email->Body      = '';

$sql = "SELECT * FROM product WHERE user_id = ".$_SESSION['user_id']." AND available_qty < 45";
echo $sql;
$result = mysqli_query($conn, $sql);
$head = "product_code       product_name        product_price       available_qty\n";
$content = '';
while($row = mysqli_fetch_assoc($result))
{
	$content .= $row['product_code']."      ".$row['product_name']."        ".$row['product_price']."       ".$row['available_qty']."\n";
}
if(strlen($content) > 0)
{
    
    $email->Body = $head.$content;
    $email->AddAddress($_SESSION['email']);
    $email->addReplyTo("shashikira4124@gmail.com", "Admin");
    if($email->Send())
    {
        echo "Success";
    }
    else
    {
        echo "Failed";
    }
}


?>