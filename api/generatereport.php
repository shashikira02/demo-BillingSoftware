<?php
  include 'connect.php';
  if (!isset($_SESSION['email'])) {
    header('location: login.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Generate Report</title>
    <link rel="shortcut icon" href="ICON.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="generatereport.css">
</head>
<body>
 
<!-- Vertical navbar -->
<?php
  include 'navbar.php'
?>
<!-- End vertical navbar -->


<!-- Page content holder -->
<div class="page-content p-5" id="content">
  <!-- Toggle button -->
  <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Menu</small></button>

  <!-- Demo content -->
    <h2 class="display-4 text-white text-center title">REPORT GENERATOR</h2>
  <div class="separator"></div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mycardcolor text-white card mt-5">
                    <div class="card-body border-0">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" value="<?php if(isset($_POST['from_date'])){ echo $_POST['from_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" value="<?php if(isset($_POST['to_date'])){ echo $_POST['to_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Click to Filter</label> <br>
                                      <button type="submit" class="btn btn-light">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body mycardcolor border-0">
                        <table class="table text-white table-border">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Bill Id</th>
                                    <th>Mode</th>
                                    <th>Customer Name</th>
                                    <th>Customer Mobile</th>
                                    <th>Quantity</th>
                                    <th>Total Cost</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php 
                                // $con = mysqli_connect("localhost","root","","billsoftware");

                                if(isset($_POST['from_date']) && isset($_POST['to_date']))
                                {
                                    $from_date = $_POST['from_date'];
                                    $_SESSION['from_date'] = $_POST['from_date'];
                                    $to_date = $_POST['to_date'];
                                    $_SESSION['to_date'] = $_POST['to_date'];
                                    $sesid=$_SESSION['user_id'];

                                    $query = "SELECT bill_id,payment_mode,customer_name,customer_phone,SUM(product_qty) AS quan,SUM(product_price*product_qty) AS totalcost,date FROM bill natural join bill_item WHERE user_id='$sesid' AND date BETWEEN '$from_date' AND '$to_date' GROUP BY bill_id";
                                    $query_run = mysqli_query($conn, $query);
                                    $countervar = 1;

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $countervar; ?></td>
                        
                                                <td><?= $row['bill_id']; ?></td>
                                                <td><?= $row['payment_mode']; ?></td>
                                                <td><?= $row['customer_name']; ?></td>
                                                <td><?= $row['customer_phone']; ?></td>
                                                <td><?= $row['quan']; ?></td>
                                                <td><?= $row['totalcost']; ?></td>
                                                <td><?= $row['date']; ?></td>
                                            </tr>
                                            <?php
                                            $countervar++;
                                        }
                                    }
                                    else
                                    {
                                        echo "<span class='text-white'>"."No Record Found"."</span> <br>";
                                    }
                                }
                            ?>
                            </tbody>
                        </table> <br>
                        <div style="display: flex; justify-content:center" class="text-center">
                            <form action="reportaspdf.php" method="POST">
                        <button type="submit" name="printpdf" class="mr-3 btn btn-light">Print</button>
                        </form>
                            <form action="reportaspdf.php" method="POST">
                        <button type="submit" name="downloadpdf" class="btn btn-light">Download</button>
                        </form>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
  
  <div class="row text-white">
    
</div>
<div class="footer">
    <p>&copy; Copyright Shashi Kiran</p>
</div>  




</div>





<!-- End demo content -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>

