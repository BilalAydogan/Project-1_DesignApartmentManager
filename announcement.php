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
    
    if(empty(trim($_POST["title"]))){
        $title_err = "Please enter a title.";
    }
    else{
        $title = trim($_POST["title"]);
    }
    if(empty(trim($_POST["content"]))){
        $content_err= "Pleaser enter content.";
    }
    else{
        $content = trim($_POST["content"]);
    }
    if(empty($title_err) && empty($content_err)){
        $sql = "INSERT INTO announcement(title, content) VALUES(?, ?)";
        if($stmt = $mysqli->prepare($sql)){
          $stmt->bind_param("ss", $param_title, $param_content );
          $param_title = $title;
          $param_content = $content;
            if($stmt->execute()){
                header("location: announcement.php");
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
    </script>  
    
</head>
<body>
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
         <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
          <label for="textarea">Title</label>
           <input type="text" name="title" value="<?php echo $title; ?>">
           <span class="help-block"><?php echo $title_err; ?></span>
         </div>
          <div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
           
           <label for="content">Subject Content</label>
            <input type="text" name="content" value="<?php echo $content; ?>">
            <span class="help-block"><?php echo $content_err; ?></span>
          </div>
            
            <button class="btn btn-primary" value="Submit">Submit</button>
             <a href="adminmain.php" class="btn btn-danger">Back</a>  
        </div>
    </form>
 
</body>  

</html>