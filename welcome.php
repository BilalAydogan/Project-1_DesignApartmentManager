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
        <a href="paydues.php" class="btn btn-primary">Pay Dues</a>
        <a href="reset-password.php" class="btn btn-warning">Change Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        <a href="main.php" class="btn btn-danger">Back</a>
        
    </p>
    <p>
       <?php
        require_once "config.php";
       $un = $_SESSION["username"];
        $dues="";
        $sql = "SELECT dues FROM users WHERE username='$un'";
        $result = mysqli_query($mysqli, $sql);
        $rescheck = mysqli_num_rows($result);
        if($rescheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $dues=$row['dues'];
            }   
        }
        
        ?>
        Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.Your dues this month <b><?php echo $dues;?> TL</b>
    </p>
    
</body>
</html>