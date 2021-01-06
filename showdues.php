<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
?>

<html>
<head>
<meta charset="utf-8">
   
<title>All Member</title>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
        function back(){
            window.location="main.php"
        }
    </script>    
</head>
    <body>
    
    <div class="container">
       <div class="row  justify-content-center">
          <div class="col">
             <table class="table table-bordered table-striped table-white">
                 <tr>
                     <td>User Id</td>    
                     <td>User Name</td>
                     <td>Month</td>
                     <td>Year</td>
                     <td>Paid Dues</td>
                     <td>Paid Time</td>
                 </tr>
                 
                 <?php
                    $username = $_SESSION['username'];
                    $sql = "SELECT id, username, month, year, paydues, created_at FROM duespaid WHERE username='$username';";
                    $result = mysqli_query($mysqli, $sql);
                    $rescheck = mysqli_num_rows($result);

                if($rescheck > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['month']."</td>";
                        echo "<td>".$row['year']."</td>";
                        echo "<td>".$row['paydues']." TL"."</td>";
                        echo "<td>".$row['created_at']." TL"."</td>"; 
                        }
                    }

                ?>
             </table>
              
          </div>
           
       </div>
        
    </div>
    <div class="container" >
    <a href="main.php" class="btn btn-primary">Back</a>
    </div>

    </body>
</html>