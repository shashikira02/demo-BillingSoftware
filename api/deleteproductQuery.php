<?php

include 'connect.php';
$sql = "DELETE FROM product WHERE user_id='" . $_SESSION["user_id"] . "' AND  product_code='" . $_GET["productcode"] . "'";
$rowId = ($_GET["rowid"]) - 1 ;
if (mysqli_query($conn, $sql)) {
        echo "<script>alert(\"Deleted " . $_GET["productname"] ."\");window.location='productshorthand.php'</script>";
    }
    else{
        echo "<script>alert('Failed to delete ". $_GET["productname"] ."');window.location='productshorthand.php". $rowId ."'</script>";
        header("location:productshorthand.php");
}

?>
