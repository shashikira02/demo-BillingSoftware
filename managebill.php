<?php
  include 'connect.php';
  if (!isset($_SESSION['email'])) {
    header('location: login.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Bill</title>
    <link rel="shortcut icon" href="ICON.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="managebill.css">
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
  <h2 class="display-4 text-white text-center title">MANAGE BILL</h2> <br><br>
  <!-- <div class="separator"></div> -->

  <table class="table text-white table-border table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Bill Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Mode</th>
                                    <th>Bill</th>
                                    <th>Edit</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
      <?php
        $sesid=$_SESSION['user_id'];
        $query = "SELECT *  FROM bill WHERE user_id='$sesid'";
        $query_run = mysqli_query($conn, $query);
        $sno = 0;
                      while($row = mysqli_fetch_assoc($query_run))
                      {
                        $sno = $sno + 1;
                        echo "<tr>
                        <th>". $sno . "</th>
                        <td>". $row['bill_id'] . "</td>
                        <td>". $row['customer_name'] . "</td>
                        <td>". $row['customer_mail'] . "</td>
                        <td>". $row['customer_phone'] . "</td>
                        <td>". $row['payment_mode'] . "</td>
                        <td><form action='viewbill.php' method='get'> <input type='hidden' name='bill_id' value=". $row['bill_id'] ." /><button type='submit' class='edit btn btn btn btn-outline-light'> view bill </button></form></td>
                        <td> <button class='edit btn btn btn btn-outline-light' id=".$sno."> Edit </button></td>";
                        ?>
                        
                        </tr>
                        <?php
                      }
      ?>
      </tbody></table>
      <?php
$insert = false;
$update = false;
$delete = false;

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `bill` WHERE `bill_id` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['savechanges'])){
    // Update the record
      $billid = $_POST["billidEdit"];
      $name = $_POST["nameEdit"];
      $mobile = $_POST["mobileEdit"];
      $email = $_POST["emailEdit"];

    // Sql query to be executed
    $sql = "UPDATE bill SET customer_name = '$name', customer_phone = '$mobile', customer_mail = '$email' WHERE user_id =".$_SESSION['user_id']." AND bill_id = $billid";
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
      echo "<script>window.onload = function() {
        if(!window.location.hash) {
            window.location = window.location + '#loaded';
            window.location.reload();
        }
    }</script>";
    }
  } 
  else{
    echo "<script>alert('Failed to update!');</script>";
  }
}
?>
  
  <div class="row text-white">
    
</div>
<div class="footer">
    <p>&copy; Copyright Shashi Kiran</p>
</div>  




</div>

<!-- Edit Button Popup -->
  <!-- Edit Modal UI -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit your Bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="managebill.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <input type="hidden" class="form-control" id="billidEdit" name="billidEdit" aria-describedby="emailHelp" >
            <div class="form-group">
              <label for="title">Name</label>
              <input type="text" pattern="^[a-zA-Z ]+$" required class="form-control"
                id="nameEdit" name="nameEdit" maxlength="20" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="title">Mobile</label>
              <input type="text" pattern="^[0-9]+$" required class="form-control"
                id="mobileEdit" name="mobileEdit" maxlength="10" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="title">Email</label>
              <input type="email" required class="form-control"
                id="emailEdit" name="emailEdit" maxlength="20" aria-describedby="emailHelp">
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="savechanges" class="btn btn-outline-secondary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Modal invoke -->
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode;
        billid = tr.getElementsByTagName("td")[0].innerText;
        name = tr.getElementsByTagName("td")[1].innerText;
        mobile = tr.getElementsByTagName("td")[3].innerText;
        email = tr.getElementsByTagName("td")[2].innerText;
        billidEdit.value = billid;
        nameEdit.value = name;
        mobileEdit.value = mobile;
        emailEdit.value = email;
        snoEdit.value = e.target.id;
        $('#editModal').modal('toggle');
      })
    })
  </script>
  <!-- End Edit Button Popup -->


<!-- End demo content -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>
