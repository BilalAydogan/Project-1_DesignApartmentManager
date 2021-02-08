<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
?>

<?php
$paid=1;
$sql1 ="UPDATE dues SET paidtime= now() WHERE id='$_GET[id]'";
$sql="UPDATE dues SET ispaid = $paid WHERE id='$_GET[id]'";

  if(mysqli_query($mysqli,$sql1)){
    if(mysqli_query($mysqli,$sql)){
        header("location: adminpay.php");
    }
  }
    else{
        header("location: adminmain.php");
    }
                


?>
