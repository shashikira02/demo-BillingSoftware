<?php
  include 'connect.php';
  if (!isset($_SESSION['email'])) {
    header('location: login.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Shorthand</title>
    <link rel="shortcut icon" href="ICON.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="productshorthand.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
 
<?php
  include 'navbar.php'
?>


<!-- Page content holder -->
<div class="page-content p-5" id="content">
  <!-- Toggle button -->
  <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Menu</small></button>

  <!-- Demo content -->
  <h2 class="display-4 text-white text-center title">PRODUCT SHORTHAND</h2>
  <div class="separator"></div>
  <div class="row text-white">
    <div class="col-sm-6">
      <p class="lead">
        <form action=" " method="POST">
          <div class="form-group row d-flex justify-content-center">
            <label for="pcode" class="col-sm-2 col-form-label text-light">Product Code</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="pcode" id="pcode" placeholder="Code">
            </div>
          </div>
          <div class="form-group row d-flex justify-content-center">
              <label for="pname" class="col-sm-2 col-form-label text-light">Product Name</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="pname" id="pname" placeholder="Name">
              </div>
            </div>
          <div class="form-group row d-flex justify-content-center">
            <label for="pprice" class="col-sm-2 col-form-label text-light">Product Price</label>
            <div class="col-sm-3">
             <input type="text" class="form-control" name="pprice" id="pprice" placeholder="Price">
             </div>
          </div>
          <div class="form-group row d-flex justify-content-center">
            <label for="pprice" class="col-sm-2 col-form-label text-light">Quantity</label>
            <div class="col-sm-3">
             <input type="number" class="form-control" name="availableQty" id="availableQty" placeholder="Quantity">
             </div>
          </div>
            
          <div class="form-group row">
            <div class="col-sm-10 mt-4 text-center">
              <button type="submit" class="btn btn-light" name="submit"><b>Add Record</b></button>
            </div>
          </div>
        </form>
      </p>
      
    </div>
    <div class="col-sm-6">
      <?php
      $value=$_SESSION['user_id'];
          $sql="SELECT * FROM product WHERE user_id='$value' ORDER BY user_id DESC";
          $result = mysqli_query($conn,$sql);
          $num_rows= mysqli_num_rows($result);
          if ($num_rows>= 1) {
              echo "<input class='form-control' id='myInput' type='text' placeholder='Search..'><br>"; 
              echo "<center><table id='dtBasicExample' class='table table-striped table-responsive' ><thead><tr><th>Code</th><th>Item Name</th><th>Price</th><th>Available</th><th>Edit</th><th>Delete</th></thead></tr>";
              $count=1;
              while($num_rows!=0)
              {
                  $row = mysqli_fetch_assoc($result);
                  echo "<tbody id='myTable'><tr><td>".$row['product_code']."</td><td>".$row['product_name']."</td><td>".$row['product_price']."</td><td>".$row['available_qty']."</td><td> <button class='edit btn btn btn btn-outline-light' id=".$count."> Edit </button></td><td><button class='edit btn btn btn btn-outline-light'>
                  <a style=\"text-decoration: none; color:red; font-weight:500;\" href=\"deleteproductQuery.php?productcode=".$row['product_code']."&rowid=".$count."&productname=".$row['product_name']."\">Delete</a>
                </button></td></tr></tbody>";
                  $num_rows--;
                  $count++;
              }
              echo "</table><center>";
          }else{
              echo "<center><h3>Add products!!<h3></center>";
          }
      ?>      
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

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
      $id=$_SESSION['user_id'];
      $pcode = $_POST['pcode'];
      $pname=$_POST['pname'];
      $pprice=$_POST['pprice'];
      $availableQty=$_POST['availableQty'];
      $sql = "INSERT INTO product(user_id,product_code,product_name,product_price, available_qty) VALUES ('$id','$pcode','$pname','$pprice', '$availableQty')";
      $result = mysqli_query($conn, $sql);
      if($result == FALSE)
      {
        echo("<script>alert('Failed to add')</script>");
      }
      echo("<meta http-equiv='refresh' content='1'>");
  }
?>
<!-- End demo content -->

<script>
  $("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    
    $("#myTable tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>

