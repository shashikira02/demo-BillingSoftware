<?php

include 'connect.php';
if(MD5($_GET['enteredCode'])==$_GET['codehashed'])
{
            $email = $_GET['email'];
            $query = "SELECT * FROM storeowner WHERE user_mail='$email'";
            $result = mysqli_query($conn, $query)or die($mysqli_error($conn));
            $num = mysqli_num_rows($result);
            if ($num==0) 
            {
              echo "Account Doesn't Exists";
            } 
            else 
            {  
              $row = mysqli_fetch_array($result);
              // "<script>alert(".isset($_SESSION['email']).")</script>"
              

              $_SESSION['email'] = $row['user_mail'];
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['name']=$row['store_name'];
              echo "Success";
            }
}
else
{
    echo "Incorrect Code";
}?>