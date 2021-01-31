<?php
session_start();
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
?>
<?php
require_once "config.php";
 $paydues = $username= $year=$month="";
 $paydues_err="";
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     if(empty(trim($_POST["paydues"]))){
         $paydues_err="Please enter dues";
     }
     else{
         $paydues=trim($_POST["paydues"]);
     }
     if(!empty(trim($_SESSION["username"]))){
         $username=trim($_SESSION["username"]);
     }
     if(!empty(trim($_POST["year"]))){
         $year=trim($_POST["year"]);
     }
     if(!empty(trim($_POST["month"]))){
         $month=trim($_POST["month"]);
     }
     
     if(empty($paydues_err)){
         $username = $_POST['username'];
         $year=$_POST['year'];
         $month=$_POST['month'];
         $paydues=$_POST['paydues'];
         $sql="UPDATE users SET dues = dues-$paydues WHERE username='$username'";
         $sql1="INSERT INTO duespaid (username, month, year, paydues) VALUES ('$username','$month','$year','$paydues')";
         if(mysqli_query($mysqli,$sql)){
             if(mysqli_query($mysqli,$sql1)){
                 header("location: adminwelcome.php");
             }
         }
         else{
             header("location: adminmain.php");
         }
     }
     
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Pay</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script type="text/javascript">
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
   <div class="form-group ">
                <label>User Name</label>
                <input type="text" name="username" class="form-control" placeholder="User Name">
           </div>
           <div class="form-group" >
            <label >Please Choose Month</label>
            <select name="month" class="form-control">
              <option value="January">January</option>
              <option value="February">February</option>
              <option value="March">March</option>
              <option value="April">April </option>
              <option value="May">May </option>
              <option value="June">June </option>
              <option value="July">July </option>
              <option value="August">August </option> 
              <option value="September">September </option>
              <option value="October">October </option>
              <option value="November">November </option>
              <option value="December">December </option>
            </select>
            </div>
            <div class="form-group ">
                <label>Year</label>
                <input type="text" name="year" class="form-control" value="2021"onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
           </div>
       <div class="form-group <?php echo (!empty($updatedues_err)) ? 'has-error' : ''; ?>">
                <label >Pay Dues</label>
                <input type="text" name="paydues" class="form-control" placeholder="Please Enter a Dues" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                <span class="label label-danger"><?php echo $paydues_err; ?></span>
       </div>
       
   </div>
   <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit">
    <a href="welcome.php" class="btn btn-danger">Back</a>
    </div>
    </form>  
</main>
            
</section>
        
</div>
    <footer>Bilal AYDOGAN &copy; | 2020-2021</footer>
</body>
</html>