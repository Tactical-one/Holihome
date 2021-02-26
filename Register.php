<?php
include("connection.php"); 

if (isset($_POST["register"])){ 
  $nameErr = $emailErr = $passwordErr = $rep_passwordErr = $msg = "";
  $firstname = $lastname = $email = $password = $rep_password = "";

  if (empty($_POST["firstname"])){ 
    $nameErr = "Required!";
  }else{
    $firstname = $_POST["firstname"];
  }

  if (empty($_POST["lastname"])){
    $nameErr = "Required!";
  }else{
    $lastname = $_POST["lastname"];
  }

  if(empty($_POST["email"])){
    $emailErr = "Required!";
  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $emailErr = "Invalid Email Format!";
  }else{
    $email = $_POST["email"];
  }

// Validate password
  if(empty($_POST["password"])){
    $passwordErr = "Required!";
  }elseif(strlen($_POST["password"]) < 4){
    $passwordErr = "Must have atleast 4 characters!";
  }else{
    $password = $_POST["password"];
  }

  // Validate confirm password
if(empty($_POST["rep_password"])){
  $rep_passwordErr = "Required!";
}else{
  $rep_password = $_POST["rep_password"];
  if(empty($passwordErr) && ($password != $rep_password)){
    $rep_passwordErr = "Password not a match!!";
  }
}

// first check the database to make sure 
  // a user does not already exist with the same email
  $user_check_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user['email'] === $email){
    $msg = "Email already exists!";
  }


// Check input errors before inserting in database
if(empty($emailErr) && empty($passwordErr) && empty($rep_passwordErr) && empty($msg)){
  $sql = "INSERT INTO users (firstname, lastname, email, password)
          VALUES ('$firstname', '$lastname', '$email', '$password')";

          mysqli_query($db, $sql);
          $_SESSION['user_id'] = $email;
          header("Location:dashboard.php");
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
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/custom.css" rel="stylesheet" />
    </head>

    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php">HoliHome</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                      <!--  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>         -->
                      <!--  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">Register</a></li>       -->
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login.php">Log In</a></li>          
                    </ul>
                </div>
            </div>
        </nav>
        <!-- nav end -->

        <main> 
<div class="container-fluid">
                <div class="row no-gutter">
                  <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image-register"></div>
                  <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4">Register</h3> 
                            <p style="color:red;"><?php if(isset($msg)){echo $msg;} ?></p>

                            <form id="register" method="post" action="">

                              <div class="form-label-group">
                                <input type="text" id="inputFirstname" class="form-control" value="<?php if(isset($firstname)){ echo $firstname;} ?>" placeholder="Firstname" name="firstname" required autofocus>
                                <label for="inputFirstname">Firstname</label>

                                <span style="color:red;"><?php if(isset($nameErr)){echo $nameErr;} ?></span>
                              </div> 

                              <div class="form-label-group">
                                <input type="text" id="inputLastname" class="form-control" value="<?php if(isset($lastname)){echo $lastname;} ?>"  placeholder="Lastname" name="lastname" required>
                                <label for="inputLastname">Lastname</label>

                                <span style="color:red;"><?php if(isset($nameErr)){ echo $nameErr;} ?></span>
                              </div>

                              <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" value="<?php if(isset($email)){ echo $email;} ?>" placeholder="Email address" name="email" required>
                                <label for="inputEmail">Email address</label>

                                <span style="color:red;"><?php if(isset($emailErr)){echo $emailErr;} ?></span>
                              </div> 
              
                              <div class="form-label-group">
                                <input type="password" minlength="4" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                                <label for="inputPassword">Password</label>

                                <span style="color:red;"><?php if(isset($passwordErr)){echo $passwordErr;} ?></span>
                              </div> 

                              <div class="form-label-group">
                                <input type="password" minlength="4" id="inputConfirmPassword" class="form-control" placeholder="Password" name="rep_password" required>
                                <label for="inputConfirmPassword">Confirm Password</label>
                                
                                <p style="color:red;"><?php if(isset($rep_passwordErr)){echo $rep_passwordErr;} ?></p>
                              </div> 

                              <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" name="register" type="submit">Register</button>
                              <div class="text-center">
                                <p class="small">Already have an account? <a class="small" href="login.php">Log In</a></div></p>
                                
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

</main>


               
<!-- Footer-->
<footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © HoliHome 2021</div></footer>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>


</body>
    </html>