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
	$shopname = $_SESSION['name'];
	$content = "";
	$content .= "<h1 class='text-center' style='text-align:center;'> ".$shopname."</h1>";
	
	$content .= "
	<center><h3>Your Bill Report</h3></center><br><hr><br><br>
    <table class='table text-white table-border'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Bill Id</th>
                <th>Mode</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Quantity</th>
                <th>Total Cost</th>
				<th>Date</th>
            </tr>
        </thead>
		<tbody>";
		    // $con = mysqli_connect("localhost","root","","billsoftware");
			if(isset($_SESSION['from_date']) && isset($_SESSION['to_date']))
			{
				$from_date = $_SESSION['from_date'];
				$to_date = $_SESSION['to_date'];
				$sesid=$_SESSION['user_id'];
				$query = "SELECT bill.bill_id as bill_id, payment_mode, customer_name, customer_phone, date, product_qty, SUM(product_qty*product_price) as totalcost FROM bill, bill_item WHERE bill.user_id=bill_item.user_id and bill.bill_id=bill_item.bill_id and bill.user_id='$sesid' AND date BETWEEN '$from_date' AND '$to_date' group by bill.bill_id";
				$query_run = mysqli_query($conn, $query);
				// echo $query;
				$countervar = 1;

					foreach($query_run as $row)
					{
								$content.='  
								<tr>   
									<td>'.$countervar.'</td> 
									<td>'.$row["bill_id"].'</td> 
									<td>'.$row["payment_mode"].'</td>
									<td>'.$row["customer_name"].'</td>
									<td>'.$row["customer_phone"].'</td>
									<td>'.$row["product_qty"].'</td>
									<td>'.$row["totalcost"].'</td>
									<td>'.$row["date"].'</td>
								</tr>';
								$countervar++;
					}
					$content.='</table>';
			}
	$obj_pdf->WriteHTML($content);
	$obj_pdf->Output("Report.pdf");
?>