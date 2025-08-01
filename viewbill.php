<?php
  include 'connect.php';
  if (!isset($_SESSION['email']) || empty($_GET["bill_id"])) {
    header('location: login.php');
  }
 
?>
<?php
	include 'connect.php';
	$sql = "SELECT * FROM bill WHERE user_id=".$_SESSION['user_id']." AND bill_id= ".$_GET["bill_id"]." ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $content = $row['pdf'];


	header("Content-type:application/pdf");
	// header("Content-Disposition:attachment;filename='pdf.pdf'");

	echo $content;
?>