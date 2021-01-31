<?php
session_start();
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
require_once "config.php";
 $updatedues ="";
 $updatedues_err="";
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     if(empty(trim($_POST["updatedues"]))){
         $updatedues_err="Please enter dues";
     }
     else{
         $updatedues=trim($_POST["updatedues"]);
     }
     
     if(empty($updatedues_err)){
         $sql="UPDATE users SET dues = dues+$updatedues";
         if($stmt = $mysqli->prepare($sql)){
             $stmt->bind_param("i", $param_updatedues);
             $param_updatedues=updatedues;
             if($stmt->execute()){
                header("location: allmember.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
         }
     }
     $mysqli->close();
     
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
    function back(){
        window.location="adminmain.php"
    } 
    function login(){
        window.location="adminwelcome.php"
    }
    function register(){
        window.location="register.php"
    }
    function homepage(){
        window.location="adminmain.php"     
    }
    function adminreg(){
        window.location="adminregister.php"
    }
    function allmember(){
        window.location="allmember.php"
    }
    function leaving(){
        window.location="leaving.php"
    }
    function announcement(){
        window.location="announcement.php"
    }
    </script>
    <title>Update Dues</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="adminmain.php">AYDOGAN APT MANAGEMENT |Welcome To AYDOGAN Apartment Management System...</a>
    </div>
   
    <i class="fas fa-search"></i>
    <i class="fab fa-facebook"></i>
    <i class="fab fa-instagram"></i>
    <button type="button" class="btn btn-light" onclick="login()">My Profile!</button>
    <button type="button" class="btn btn-light" onclick="announcement()">Make Announcement</button>
    <button type="button" class="btn btn-light" onclick="allmember()">All Member</button>
    <button type="button" class="btn btn-light" onclick="leaving()">Leaving Users</button>
    <button type="button" class="btn btn-light" onclick="register()">User Register</button>
    <button type="button" class="btn btn-light" onclick="adminreg()">Admin Register</button>
    
    </div>
    </nav>
<div id="container">
<section>
            <nav class="navbar navbar-expand-sm bg-light">
                <ul>
                    <li><a href="adminmain.php"><i class="fas fa-home"></i>Home Page</a></li>
                    <li><a href="updatedues.php"><i class="fas fa-wallet"></i>Add Dues</a></li>
                    <li><a href="alldues.php"><i class="fas fa-list"></i>All Dues History</a></li>
                    <li><a href="adminpay.php"><i class="fas fa-lira-sign"></i>Pay DUes</a></li>
                    <li><a href="income.php"><i class="fas fa-lira-sign"></i>Income-Expense</a></li>
                    <li><a href="showrequest.php"><i class="fas fa-box-open"></i>Request-Complaint</a></li>
                    <li><a href="expense.php"><i class="fas fa-box-open"></i>Expense</a></li>
                    <li><a href="showexpense.php"><i class="fas fa-box-open"></i>Show Expense</a></li>
                </ul>
                
            </nav>
            
<main>
<header> 
    <img id="headerimg" src="img/img1.jpeg" alt="">
    <div id="centered"> AYDOGAN APARTMENT </div>
</header>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   <div class="wrapper">
   <div class="form-group <?php echo (!empty($updatedues_err)) ? 'has-error' : ''; ?>">
                <label>Add Dues</label>
                <input type="text" name="updatedues" class="form-control" placeholder="Please enter a due."onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                <span class="help-block"><?php echo $updatedues_err; ?></span>
    </div>
   </div>
   <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit">
    <a href="adminmain.php" class="btn btn-danger">Back</a>
    </div>
    </form>
    </main>
    </section>
    </div>
    <footer>Bilal AYDOGAN &copy; | 2020-2021</footer>
</body>

</html>