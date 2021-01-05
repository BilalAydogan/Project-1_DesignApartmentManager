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
    <title>Main Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
    function login(){
        window.location="welcome.php"
    }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="main.php">AYDOGAN APT MANAGEMENT |Welcome To AYDOGAN Apartment Management System...</a>
    </div>
   
    <i class="fas fa-search"></i>
    <i class="fab fa-facebook"></i>
    <i class="fab fa-instagram"></i>
    <button type="button" class="btn btn-light" onclick="login()">My Profile!</button>
    </div>
    </nav>
    
<div id="container">
<section>
            <nav class="navbar navbar-expand-sm bg-light">
                <ul>
                    <li><a href="main.php"><i class="fas fa-home"></i>Home Page</a></li>
                </ul>
            </nav>
            
<main>
<header> 
    <img id="headerimg" src="img/img1.jpeg" alt="">
    <div id="centered"> AYDOGAN APARTMENT </div>
</header>
        <div class="announcement">

            <h5>Announcements</h5>
                <p class="annotext">You can see all announcements.</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">See All Announcements</button>
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">All Announcement</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-striped table-white">
                                     <tr>
                                         <td>Title</td>    
                                         <td>Content</td>
                                    </tr> 
                                <?php
                                    require_once "config.php";
                                    $sql = "SELECT title, content FROM announcement ORDER BY created_at DESC;";
                                    $result = mysqli_query($mysqli, $sql);
                                    $rescheck = mysqli_num_rows($result);

                                if($rescheck > 0){
                                    while($row = mysqli_fetch_assoc($result)){

                                        echo "<tr>";
                                        echo "<td>".$row['title']."</td>";
                                        echo "<td>".$row['content']."</td>";
                                        echo "</tr>";
                                        }
                                    }
                                ?>
                                </table>
                               </div>
                    </div>
              </div>
            </div>
        </div>
</div>        
</main> 
</section>      
    <footer>Bilal AYDOGAN &copy; | 2020-2021</footer>
</body>
</html>
