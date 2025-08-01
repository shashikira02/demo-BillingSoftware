<?php
  include 'connect.php';
  if (!isset($_SESSION['admin'])) {
    echo '
    <script>
        alert("Unauthorized to this page");
    </script>
    ';

    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }

    echo "<a href=\"<?= $previous ?>\">Back</a>";


    // exit;
  }
  $sql = "DELETE FROM bill_item WHERE user_id=".$_GET['user_id'];
  $result = mysqli_query($conn, $sql);
  $sql = "DELETE FROM storeowner WHERE user_id=".$_GET['user_id'];
  $result = mysqli_query($conn, $sql);
  $sql = "DELETE FROM bill WHERE user_id=".$_GET['user_id'];
  $result = mysqli_query($conn, $sql);
  echo '
    <script>
        alert("Account Deleted Successfully");
    </script>
    ';
  header('location: login.php');
?>




