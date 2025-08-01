<?php
session_start();
if(isset($_SESSION['email']))
{
  header('location: index.php');
  exit;
}
  include 'connect.php';
?>


<html>
  <head>
      <title>LOGIN</title>
      <link rel="shortcut icon" href="ICON.png" type="image/png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
      <link rel="stylesheet" href="login.css">
  </head>
  <body> 
      <form method="post" action="" class="login">
          <header>LOGIN</header>
          <div class="field">
              <span class="fa fa-user"></span>
              <input type="email" name="email" placeholder="Email ID" required>
          </div>
          <div class="field">
            <span class="fa fa-lock"></span>
            <input type="password" name="pass" placeholder="Password" required>
          </div>
          <!-- <div class="forgot-password">
              <a href="#">Forgot password?</a>
          </div> -->
          <input type="submit" class="submit" value="LOGIN">
          <span class="logn-form-copy">Don't have an account? <a href="signup.php" class="login-form__sign-up">Sign up</a></span>
          <span class="logn-form-copy">Login with OTP <a href="SSO.php" class="login-form__sign-up">SSO</a></span>
    </form><br>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $email=$_POST['email'];
            $pass=$_POST['pass'];
            $query = "SELECT * FROM storeowner WHERE user_mail='$email' AND user_pwd=SHA('$pass')";
            $result = mysqli_query($conn, $query)or die($mysqli_error($conn));
            $num = mysqli_num_rows($result);
            if ($num==0) {
              echo '<script>alert("Account Doesnt Exists");</script>';
            } else {  
              $row = mysqli_fetch_array($result);
              // "<script>alert(".isset($_SESSION['email']).")</script>"
              

              $_SESSION['email'] = $row['user_mail'];
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['name'] = $row['store_name'];
              header('location: index.php');
            }
        }
      ?>
  </body>
</html>

