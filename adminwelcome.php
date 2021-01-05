<?php
session_start();
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
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
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to management panel of the apartment site.</h1>
    </div>
    <p>
        <a href="adminreset.php" class="btn btn-warning">Change Your Password</a>
        <a href="adminlogout.php" class="btn btn-danger">Sign Out As a Admin</a>
        <a href="logout.php" class="btn btn-danger">Sing Out As a Member</a>
        <a href="adminmain.php" class="btn btn-danger">Back</a>
        
    </p>
</body>
</html>