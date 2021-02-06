<?php
session_start();
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
require_once "config.php";
 $updatedues = $duesname = $month= $year="";
 $updatedues_err= $duesname_err =$month_err=$year_err="";
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     if(empty(trim($_POST["updatedues"]))){
         $updatedues_err="Please enter dues";
     }
     else{
         $updatedues=trim($_POST["updatedues"]);
     }
     if(empty(trim($_POST["duesname"]))){
         $duesname_err="Please enter dues name";
     }
     else{
         $duesname=trim($_POST["duesname"]);
     }
     if(empty(trim($_POST["month"]))){
         $month_err="Please enter month";
     }
     else{
         $month=trim($_POST["month"]);
     }
     if(empty(trim($_POST["year"]))){
         $year_err="Please enter year";
     }
     else{
         $year=trim($_POST["year"]);
     }
     
     if(empty($updatedues_err)&&empty($duesname_err)&&empty($month_err)&&empty($year_err)){
            $sql = "SELECT username FROM users";
                $result = mysqli_query($mysqli, $sql);
                $rescheck = mysqli_num_rows($result);
            if($rescheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $uname = $row['username'];
$sql2 = "INSERT INTO dues(username,updatedues,duesname,month,year) VALUES('$uname','$updatedues','$duesname','$month','$year')";
                $run = mysqli_query($mysqli,$sql2);
                    if($run){
                        header("location:adminmain.php");
                    }
                    else{
                        echo "something wrong";
                    }
            }
         
     }
 }
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
   
    <div class="form-group <?php echo (!empty($duesname_err)) ? 'has-error' : ''; ?>">
                <label>Dues Name</label>
                <input type="text" name="duesname" class="form-control" placeholder="Please enter a dues name.">
                <span class="help-block"><?php echo $duesname_err; ?></span>
    </div>
    <div class="form-group <?php echo (!empty($updatedues_err)) ? 'has-error' : ''; ?>">
                <label>Dues Price</label>
                <input type="text" name="updatedues" class="form-control" placeholder="Please enter a due."onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                <span class="help-block"><?php echo $updatedues_err; ?></span>
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
    <div class="form-group">
                <label>Year</label>
                <input type="text" name="year" class="form-control" value="2021" placeholder="Please enter a due.">
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