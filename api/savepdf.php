<?php
 
  include 'connect.php';
  if (!isset($_SESSION['email'])) {
    header('location: login.php');
	exit;
  }
?>
<?php

	include 'connect.php';
	require_once('./tcpdf/tcpdf.php');
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$obj_pdf->SetTitle("YOUR BILL REPORT");
	$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
	$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->setDefaultMonospacedFont('helvetica');
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	$obj_pdf->SetMargins(PDF_MARGIN_LEFT,'0',PDF_MARGIN_RIGHT);
	$obj_pdf->setPrintHeader(false);
	$obj_pdf->setPrintFooter(false);
	$obj_pdf->SetAutoPageBreak(TRUE, 10);
	$obj_pdf->SetFont('helvetica', '', 12);
	$obj_pdf->setPrintHeader(false);
	$obj_pdf->AddPage();
	// $obj_pdf->Image("images/".$_SESSION["user_id"].".jpg",20,20,20,20,'JPG','www.plus2net.com');
	$obj_pdf->Image("images/".$_SESSION["user_id"].".jpg", 130,7,40,40);

	$content = "";
	if (!isset($_SESSION['cust_name'])) {
		// echo "<script>alert(\"failed to save\")</srcipt>";
		header('location: login.php');
	  }
	$shopname = $_SESSION['name'];
	$cname = $_SESSION['cust_name'];
	$cmobile = $_SESSION['cust_mob'];
	$caddr = $_SESSION['cust_addr'];
	$cemail = $_SESSION['cust_email'];
	$content .= "<h1 class='text-center' style='text-align:center;'> ".$shopname."</h1>";
	$content .= "<h4 style='text-align:center;'> Name : ".$cname."</h4>";
	$content .= "<h4 style='text-align:center;'> Mobile : ".$cmobile."</h4>";
	$content .= "<h4 style='text-align:center;'> City : ".$caddr."</h4>";
	$content .= "<h4 style='text-align:center;'> Email : ".$cemail."</h4>";
	$content .= "<h4 style='text-align:center;'> Bill Id : ".$_SESSION['billno']."</h4>";
	date_default_timezone_set('Asia/Kolkata');
	$time= date("M,d,Y h:i:s A", time());
	// $atime = date('Y-m-d H:i:s A',$time);

	$content .= "<h4 style='text-align:center;'> Date : ".$time."</h4>";
	$content .= "
	<h2>Your Bill Summary</h2>";
	$user=$_SESSION['user_id'];
	$val1=$_SESSION['billno'];
	$mode = $_SESSION['mode'];
	$sql = "SELECT * FROM bill_item WHERE user_id='$user' AND bill_id='$val1'";
	$result = mysqli_query($conn, $sql);
	$sql1="SELECT SUM(product_qty*product_price) AS TOTAL FROM bill_item WHERE user_id='$user' AND bill_id='$val1'";
	$result1=mysqli_query($conn, $sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$content .= "<div class='container-fluid'><center><table class='table'><tr><hr><th>ID</th><th>Item Name</th><th>Quantity</th><th>Price</th><th>Amount</th><hr></tr>";
			$count=1;
			while($row = mysqli_fetch_assoc($result))
			{
				$content .= "<tr><td>".$count."</td><td>".$row['product_code']."</td><td>".$row['product_qty']."</td><td>".$row['product_price']."</td><td>".$row['product_qty']*$row['product_price']."</td></tr>";
				$count++;
			}
			$content .= "<tr><td></td><td></td><td></td><td></td><td><b>Total: RS ".$row1['TOTAL']."</b></td></tr>";
			$content .= "</table><center></div>";
	$obj_pdf->WriteHTML($content);
	$content=$obj_pdf->Output('', 'S');

	if (mysqli_connect_errno()){ 
	// echo mysqli_error($con);
	exit();
	}
	$cont = addslashes($content);
	$sql = "DELETE FROM bill where bill_id = '$val1'";
	$result = mysqli_query($conn, $sql);

    // if(!$result)
	// {
	// 	echo "<script>alert(\"failed to delete duplicate bill\")";
	// }

	$sql = "INSERT INTO bill VALUES ('$user', '$val1', '$cname', '$cmobile', '$cemail', '$mode', '$cont')";
	$result = mysqli_query($conn, $sql);
	// echo "<script>alert(\"Saved bill\")";
	if(!$result)
	{
		// echo "<script>alert(\"failed to save bill\")";
	}


?>