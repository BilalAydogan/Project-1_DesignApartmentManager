<?php
session_start();
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
?>

<?php
$insert = "INSERT INTO leavingusers (username, password, doornumber, userphone1, userphone2, created_at)  SELECT username, password, doornumber, userphone1, userphone2, created_at FROM users WHERE id='$_GET[id]'";
$sql = "DELETE FROM users WHERE id='$_GET[id]'";
$id = $_GET[$id];
echo $id; 
if(mysqli_query($mysqli,$insert)){
if(mysqli_query($mysqli,$sql)){
    header("location: allmember.php");
}
}
else{
    header("location: adminmain.php");
}


?>
