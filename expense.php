<?php
session_start();
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php
require_once "config.php";

$title = $content="";
$title_err = $content_err="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty(trim($_POST["expensename"]))){
        $title_err = "Please enter a title.";
    }
    else{
        $title = trim($_POST["expensename"]);
    }
    if(empty(trim($_POST["cost"]))){
        $content_err= "Pleaser enter content.";
    }
    else{
        $content = trim($_POST["cost"]);
    }
    if(empty($title_err) && empty($content_err)){
        $sql = "INSERT INTO expense(expensename, cost) VALUES(?, ?)";
        if($stmt = $mysqli->prepare($sql)){
          $stmt->bind_param("ss", $param_title, $param_content );
          $param_title = $title;
          $param_content = $content;
            if($stmt->execute()){
                header("location: adminmain.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcement</title>
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
        <div class="container">
         <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
          <label for="textarea">Expense Title</label>
           <input class="form-control" type="text" name="expensename" value="<?php echo $title; ?>" placeholder="Enter a expense title">
           <span class="help-block"><?php echo $title_err; ?></span>
         </div>
          <div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
           
           <label for="content">Cost</label>
            <input class="form-control" type="text" name="cost" value="<?php echo $content; ?>" placeholder="Enter a cost"onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
            <span class="help-block"><?php echo $content_err; ?></span>
          </div>
            
            <button class="btn btn-primary" value="Submit">Submit</button>
             <a href="adminmain.php" class="btn btn-danger">Back</a>  
        </div>
    </form>
    </main>
 </section>
 </div> 
</body> 

<footer>Bilal AYDOGAN &copy; | 2020-2021</footer>
</html>
