<?php
include("../connection.php");

if (isset($_POST['login'])){
    $username = mysqli_real_escape_string($db, $_POST["uname"]);
    $password = mysqli_real_escape_string($db, $_POST["psw"]);

    $sql = "SELECT admin_ID FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) == 1){
        $_SESSION['admin'] = $username;
        header("Location:dashboard.php");
    }else{
        $msg = "Incorrect username or password!";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>HoliHome</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
        
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../admin/css/admin.css" rel="stylesheet" />
    </head>

    <body>

    <h2 style="margin-left:45%; margin-right:auto;">Admin Login</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto; margin-left:47%;">Login</button>
<p style ="color:red; margin-left:43%;"><?php if(isset($msg)){echo $msg;}?></p>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="" method="post">
    

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <p style ="color:red;"><?php if(isset($msg)){echo $msg;}?></p>
        
      <button type="submit" name="login">Login</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      
    </div>
  </form>
</div>


<script src = "../admin/js/javascript.js"></script>

    </body>
</html>