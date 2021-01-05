<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Apartment site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Change Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
         <a href="main.php" class="btn btn-danger">Back</a>
        
    </p>
</body>
</html>