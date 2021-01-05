<?php
session_start();
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php
require_once "config.php";
$username = $password = $confirm_password =  $userphone1 = $userphone2 = $doornumber = "";
$username_err = $password_err = $confirm_password_err = $userphone1_err = $userphone2_err = $doornumber_err= "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    if(empty(trim($_POST["userphone1"]))){
        $userphone1_err = "Please fill user main phone number.";     
    }elseif(strlen(trim($_POST["userphone1"])) != 11){
        $userphone1_err = "Phone number must have 11 digits.";} 
    else{
        $userphone1 = trim($_POST["userphone1"]);
        }
    if(empty(trim($_POST["userphone2"]))){
        $userphone2_err = "Please fill  user second phone number.";     
    } elseif(strlen(trim($_POST["userphone2"])) != 11){
        $userphone2_err = "Phone number must have 11 digits.";}
    else{
        $userphone2 = trim($_POST["userphone2"]);
        }
    if(empty(trim($_POST["doornumber"]))){
        $doornumber_err = "Please choose your door number .";     
    } 
    $sql2 = "SELECT id FROM users WHERE doornumber = ?";
        
        if($stmt = $mysqli->prepare($sql2)){
            $stmt->bind_param("s", $param_doornumber);
            
            $param_doornumber = trim($_POST["doornumber"]);
            
            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows == 1){
                    $doornumber_err = "This doornumber is already taken.";
                } else{
                    $doornumber = trim($_POST["doornumber"]);
                }
            }
        }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($userphone1_err) && empty($userphone2_err) &&empty($doornumber_err)){
        $sql = "INSERT INTO users(username, password, userphone1, userphone2, doornumber) VALUES(?, ?, ?, ?,?)" ;   
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sssss", $param_username, $param_password, $param_userphone1, $param_userphone2, $param_doornumber);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_userphone1 =$userphone1;
            $param_userphone2 =$userphone2;
            $param_doornumber =$doornumber;
            
            if($stmt->execute()){
                header("location: register.php");
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
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($userphone1_err)) ? 'has-error' : ''; ?>">
                <label>Main Phone Number</label>
                <input type="text" name="userphone1" class="form-control" value="<?php echo $userphone1; ?>">
                <span class="help-block"><?php echo $userphone1_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($userphone2_err)) ? 'has-error' : ''; ?>">
                <label>Second Phone Number</label>
                <input type="text" name="userphone2" class="form-control" value="<?php echo $userphone2; ?>">
                <span class="help-block"><?php echo $userphone2_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($doornumber_err)) ? 'has-error' : ''; ?>" >
            <label >Please choose door number</label>
            <select name="doornumber" class="form-control">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option> 
            </select>
            <span class="help-block"><?php echo $doornumber_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="adminmain.php" class="btn btn-danger">Back</a>
            </div>
        </form>
    </div>    
</body>
</html>