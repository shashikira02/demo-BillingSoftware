<?php
  include 'connect.php';
  if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Giveaway Generator</title>
    <link rel="shortcut icon" href="ICON.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="giveawaygenerator.css">
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
    <h2 class="display-4 text-white text-center title">GIVEAWAY GENERATOR</h2>
    <form method="POST">
    <div class="separator"></div>
    <div class="row text-white">
      <div class="col-lg-6">
        <div class="form-group row d-flex justify-content-center">
          <label for="name" class="col-sm-3 col-form-label text-light">Number of records</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="rec" id="rec" placeholder="" required>
          </div>
        </div>
        </div>
        <br>
        <div class="col-lg-6">
        
        <div class="form-group row d-flex justify-content-center">
          <div class="btn-toolbar mr-3 ml-4" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group " role="group" aria-label="First group">
              <button type="submit" name="submit" class="btn btn-light"><b>Generate</b></button>
            </div>
          </div>
        </div>
        </div>
</form> 
<?php
  //  $con = mysqli_connect("localhost","root","","billsoftware");
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
      $id=$_SESSION['user_id'];
      $n=$_POST['rec'];
      $sql = "SELECT DISTINCT(customer_name),customer_phone,customer_mail FROM bill WHERE user_id='$id' ORDER BY RAND() LIMIT ".$n;
      $result = mysqli_query($conn, $sql);
      echo "<div class='container'><center><table class='table'><tr><th>ID</th><th>Name</th><th>Mobile</th><th>Email</th></tr>";
              $count=1;
              while($row = mysqli_fetch_assoc($result))
              {
                  echo "<tr><td>".$count."</td><td>".$row['customer_name']."</td><td>".$row['customer_phone']."</td><td>".$row['customer_mail']."</td></tr>";
                  $count++;
              }
              echo "</table><center></div>";
  }
?>
  </div>
  
  
  
  
  
  </div>
  
  
<div class="footer">
    <p>&copy; Copyright Shashi Kiran</p>
</div>  










<!-- End demo content -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>

