<?php
  include 'connect.php';
  if (!isset($_SESSION['email'])) {
    header('location: login.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Bill</title>
    <link rel="shortcut icon" href="ICON.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="createbill.css">
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
  <form method="POST"><button type="submit" name="add" style="float: right !important;margin-top:-70px;" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-plus mr-2"></i><small class="text-uppercase font-weight-bold">New Bill</small></button></form>
      
      <?php
        $value=$_SESSION['user_id'];
        $val1="";
        if (isset($_POST['add'])) {
          $query = "SELECT MAX(bill_id) AS bill_val FROM bill WHERE user_id='$value'";
          $result = mysqli_query($conn, $query)or die($mysqli_error($conn));
          while($row = mysqli_fetch_assoc($result)){
            $_SESSION['billno']=$row['bill_val']+1;
          }
          $_SESSION['cust_name']="";
          $_SESSION['cust_addr']="";
          $_SESSION['mode']="";
          $_SESSION['cust_mob']="";
          $_SESSION['cust_email']="";
          //echo "hii";
        }
        if(isset($_SESSION['billno'])){
          $val1=$_SESSION['billno'];
        }else{
          $val1="";
        }
        if(isset($_SESSION['mode'])){
          $val2=$_SESSION['mode'];
        }else{
          $val2="";
        }
        if(isset($_SESSION['cust_name'])){
          $val3=$_SESSION['cust_name'];
        }else{
          $val3="";
        }
        if(isset($_SESSION['cust_addr'])){
          $val4=$_SESSION['cust_addr'];
        }else{
          $val4="";
        }
        if(isset($_SESSION['cust_mob'])){
          $val5=$_SESSION['cust_mob'];
        }else{
          $val5="";
        }
        if(isset($_SESSION['cust_email'])){
          $val6=$_SESSION['cust_email'];
        }else{
          $val6="";
        }
      ?>
  <!-- Demo content -->
  <h2 class="display-4 text-white text-center title">CREATE BILL</h2>
  <div class="separator"></div>
  <form method="post"> 
  <div class="row text-white">
    <div class="col-lg-6">
    <div class="form-group row d-flex justify-content-center">
      <label for="name" class="col-sm-3 col-form-label text-light">Bill no.</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="billno" id="billno" value="<?php echo $val1; ?>" placeholder="" disabled>
      </div>
    </div>
    </div>
    <br>
    <div class="col-lg-6">
    
    <div class="form-group row d-flex justify-content-center">
      <label for="name" class="col-sm-2 col-form-label text-light">Mode</label>
      <div class="col-sm-3">
        <select class="form-control" name="mode" required>
          <option selected disabled hidden></option>
          <option value="Cash" <?=$val2=='Cash'? 'selected="selected"' : '';?>>Cash</option>
          <option value="UPI" <?=$val2=='UPI'? 'selected="selected"' : '';?>>UPI</option>
        </select>
        
      </div>
    </div>
    </div>
 
  
</div>
<hr style="border-top: 1px dashed rgb(255, 255, 255);">
  <div class="row text-white">
      <div class="col-lg-6">
      <div class="form-group row d-flex justify-content-center">
        <label for="name" class="col-sm-3 col-form-label text-light">Name</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $val3; ?>" required>
        </div>
      </div>
      <div class="form-group row d-flex justify-content-center">
        <label for="name" class="col-sm-3 col-form-label text-light">Mobile No.</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="mob" id="mob" placeholder="" value="<?php echo $val5; ?>" required>
        </div>
      </div>
      </div>
      <br>
      <div class="col-lg-6">
      <div class="form-group row d-flex justify-content-center">
        <label for="name" class="col-sm-2 col-form-label text-light">Address</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="addr" id="addr" placeholder="" value="<?php echo $val4; ?>" required>
        </div>
      </div>
      <div class="form-group row d-flex justify-content-center">
        <label for="name" class="col-sm-2 col-form-label text-light">Email</label>
        <div class="col-sm-5">
          <input type="email" class="form-control" name="email" id="email" placeholder="" value="<?php echo $val6; ?>" required>
        </div>
      </div>
      </div>
   
    
</div>
<hr style="border-top: 1px dashed rgb(255, 255, 255);">
  <div class="row text-white"> 
    <div class="col-sm-3">
      <p class="lead">
          <div class="form-group row d-flex justify-content-center">
            <label for="pcode" class=" col-form-label text-light">Code</label>
            <div class="col-sm-7">
            <select  class="form-control" name="pcode" id="pcode" onchange="load_item();load_price()"> 
              <option value=""></option>

              <?php 
              $sql = mysqli_query($conn, "SELECT product_code FROM product WHERE user_id=".$_SESSION['user_id']);
              while ($row = $sql->fetch_assoc()){
                $code=$row['product_code'];
                echo "<option value='$code'>" . $row['product_code'] . "</option>";
              }
              ?>
            </select>
            </div>
          </div>
      </p>
      
    </div>
    <script>
       function load_item() {
        let val = document.getElementById("pcode").value;
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","retrieve.php?codeval="+val,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("pitem").value = this.responseText;
            }
          };
        }
        function load_price() {
        let val1 = document.getElementById("pcode").value;
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","retrieve.php?priceval="+val1,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("price").value = this.responseText;
            }
          };
        }
     </script>
    <div class="col-sm-4">
      <p class="lead">
          <div class="form-group row d-flex justify-content-center">
            <label for="pcode" class=" col-form-label text-light">Item</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="pitem" id="pitem" placeholder="" disabled>
            </div>
          </div>
      </p>
    </div>
    <div class="col-sm-2">
      <p class="lead">
          <div class="form-group row d-flex justify-content-center">
            <label for="pcode" class=" col-form-label text-light">Qty</label>
            <div class="col-sm-7">
              <input value= "0" type="text" class="form-control" name="quantity" id="quantity" placeholder="" required>
            </div>
          </div>
      </p>
      
    </div>
    <div class="col-sm-3"> 
      <p class="lead">
          <div class="form-group row d-flex justify-content-center">
            <label for="pcode" class=" col-form-label text-light">Price</label>
            <div class="col-sm-5">
              <input value= "0" type="text" class="form-control" name="price" id="price" placeholder="">
            </div>
          </div>
      </p>
      
    </div>
    <div class="col-sm-1 px-1 px-sm-5 mx-auto">
    <div class="flex-row d-flex justify-content-center">
      <div class="btn-toolbar  mt-3" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group " role="group" aria-label="First group">
          <button type="submit" name="addbill" class="btn btn-light"><b>Add</b></button>
        </div>
      </div>
  </div>
  </div>
</form>
<?php
  if (isset($_POST['addbill']))
  {
     $userid=$_SESSION['user_id'];
      $billid = $_SESSION['billno'];
      $mode=$_POST['mode'];
      $_SESSION['mode']=$mode;

      $cust_name=$_POST['name'];
      $_SESSION['cust_name']=$cust_name;

      $cust_addr=$_POST['addr'];
      $_SESSION['cust_addr']=$cust_addr;

      $cust_mob=$_POST['mob'];
      $_SESSION['cust_mob']=$cust_mob;

      $cust_email=$_POST['email'];
      $_SESSION['cust_email']=$cust_email;

      $prod_code=$_POST['pcode'];
      
      $prod_quantity=$_POST['quantity'];
      $prod_price=$_POST['price'];

      $date=date("Y-m-d");
      
      $query = "INSERT INTO bill_item VALUES ('$userid','$billid','$prod_code','$prod_quantity', '$prod_price','$date')";
      if(strlen($prod_code)>0 && $prod_quantity > 0)
      {
        $result = mysqli_query($conn, $query);
        if($result)
        {
          $query = "UPDATE product SET available_qty = available_qty - ".$prod_quantity." WHERE user_id = ".$userid." AND product_code = '".$prod_code."'";
          $result = mysqli_query($conn, $query) ;
          if (!$result) 
          {
            die('Invalid query: '.$query);
            exit;
          }
        }
      }
      
      include 'savepdf.php';
      echo("<meta http-equiv='refresh' content='1'>");
  }
  // echo "<script>alert(2)</script>";
      $user=$_SESSION['user_id'];
      $sql = "SELECT * FROM bill_item WHERE user_id='$user' AND bill_id='$val1'";
      $result = mysqli_query($conn, $sql);
      $sql1="SELECT SUM(product_qty*product_price) AS TOTAL FROM bill_item WHERE user_id='$user' AND bill_id='$val1'";
      $result1=mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($result1);
      echo "<div class='container-fluid'><br><center><table class='table'><tr><th>ID</th><th>Item Name</th><th>Quantity</th><th>Price</th><th>Amount</th><th>Delete</th></tr>";
              $count=1;
              while($row = mysqli_fetch_assoc($result))
              {
                  echo "<tr><td>".$count."</td><td>".$row['product_code']."</td><td>".$row['product_qty']."</td><td>".$row['product_price']."</td><td>".$row['product_qty']*$row['product_price']."</td><td>
                  <a style=\"text-decoration: none; color:red; font-weight:500;\" href=\"deleteProductFromBill.php?product_qty=".$row['product_qty']."&product_code=".$row['product_code']."&rownum=".$count."\">Delete</a>
                </td></tr></tr>";
                  $count++;
              }
              echo "<tr><td></td><td></td><td></td><td></td><td></td><td><b>Total: RS ".$row1['TOTAL']."</b></td></tr>";
              echo "</table><center></div>";
?>
    
      </div>
     
     
      
      <div class="text-center"><br><br>
          <form action="printbill.php" method="get">
            <input type='hidden' name='bill_id' value=$val1 />
            <button type="submit" name="printbill" class="mr-3 btn btn-light"> <b>Print Bill</b> </button>
          </form>
      </div>

      <div class="text-center"><br><br>
          <form action="sendmail.php" method="get">
            <input type='hidden' id="bill_id" name='bill_id' value=$val1 />
            <button onclick="sendMail()" type="button" id="printbill" name="printbill" class="mr-3 btn btn-light"> <b>Email Bill</b> </button>
          </form>
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
<script>
  var resp;
  function sendMail()
  {
            alert('Sending Mail....');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                resp = this.responseText ;
                console.log(resp);

                alert(resp);
               
            
            }
          };
            xmlhttp.open("GET", "sendmail.php?"  , true);
            xmlhttp.send();
  }
</script>

</body>
</html>

