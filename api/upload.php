<html>
<head>
        <title>Update Profile</title>
</head>
<body bgcolor="black">
<font color="white">
<?php
        session_start();
        // echo "images/".$_SESSION["user_id"].".jpg";
        move_uploaded_file($_FILES["file"]["tmp_name"], "images/".$_SESSION["user_id"].".jpg");
        header('location: index.php');
        
?>
