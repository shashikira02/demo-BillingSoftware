<?php


  include 'connect.php';
  if (!isset($_SESSION['email'])) {
    header('location: login.php');
	exit;
  }
?>
<?php

	include 'connect.php';
	

	if (mysqli_connect_errno()){ 
	echo mysqli_error($con);
	exit();
	}
	$sql = "DELETE FROM bill_item where product_code = \"".$_GET['product_code']."\" AND bill_id=".$_SESSION['billno']." AND user_id = ".$_SESSION['user_id']."";
	$result = mysqli_query($conn, $sql);

	$query = "UPDATE product SET available_qty = available_qty + ".$_GET['product_qty']." WHERE user_id = ".$_SESSION['user_id']." AND product_code = '".$_GET['product_code']."'";
    $result = mysqli_query($conn, $query) ;
    if (!$result) 
    {
        die('Invalid query: '.$query);
        exit;
    }

  
	if(!$result)
	{
		// echo "<script>alert(\"failed to delete item\")";
	}
	else{
		include 'savepdf.php';
	}
	$rownum = $_GET['rownum'] - 1;
	header("location: createbill.php#".$rownum."");
	exit;

?>