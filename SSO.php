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
    <?php if(!isset($_GET['email'])) {?>

    <form method="get" action="" class="login">
          <header>SSO</header>
          <div class="field">
              <span class="fa fa-user"></span>
              <input  type="email" id="email"  name="email" placeholder="Email ID">
          </div>
          
          <input type="submit" class="submit" value="Send Code">
          <span class="logn-form-copy">Don't have an account? <a href="signup.php" class="login-form__sign-up">Sign up</a></span>
    </form>   

    <?php } 

    else {

        ?>
        <form method="get" action="" class="login">
          <header>SSO</header>
          <input  type="email" id="email" value="<?php echo($_GET['email']);?>"  name="email" hidden>
          <div class="field">
              <span class="fa fa-user"></span>
              <input  type="text" id="code"  name="code" placeholder="Verification Code">
          </div>
          
          <input onclick="verify()" type="button" class="submit" value="Login">
          <span class="logn-form-copy">Don't have an account? <a href="signup.php" class="login-form__sign-up">Sign up</a></span>
        </form> 

        <?php
        $code = mt_rand(100000,999999);
        $codehashed = MD5($code);
        include 'sendVerificationMail.php';
    
    ?>

    <?php } ?>

    <script>
        function verify()
        {
            var enteredCode = document.getElementById("code").value;

            if(enteredCode.length==0)
            {
                alert("Enter verification code!");
                return;
            }
            

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var resp = this.responseText ;

                
                if(resp!="Success")
                {
                    alert(resp);
                }
                else
                {
                    location.replace("index.php");
                }
            }
            };
            
            xmlhttp.open("GET", "verifySSO.php?codehashed=" + '<?php echo($codehashed) ?>' + "&enteredCode=" + enteredCode + "&email=" + '<?php echo($_GET['email']) ?>' , true);
            xmlhttp.send();

            
        }
    </script>
    
  </body>
</html>

