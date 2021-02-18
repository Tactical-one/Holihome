<?php
include("connection.php"); 


if(isset($_POST['signin'])){
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	if(empty($email) || empty($password)) {
		$msg="Both fields are required!!";
	}else{
		$sql = "SELECT user_ID FROM users WHERE email = '$email' AND password = '$password'";
		$result = mysqli_query($db,$sql);
		if(mysqli_num_rows($result) == 1){
			$_SESSION['user_id'] = $email;
			header("Location:dashboard.php");
		}else{
			$msg= "Incorrect email or password!";
		}
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
                      <!--  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Become a Host</a></li>         -->
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Register.php">Register</a></li>
                      <!--  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup">Log In</a></li>          -->
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container-fluid">
                <div class="row no-gutter">
                  <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
                  <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4">Welcome back!</h3>

                            <form id="login" method="post" action="">

                            <p style="color:red;"><?php if(isset($msg)){ print $msg; }?></p>

                              <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                                <label for="inputEmail">Email address</label>
                              </div>
              
                              <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                                <label for="inputPassword">Password</label>
                              </div>
              
                              <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember password</label>
                              </div>
                              <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" name="signin" type="submit">Sign in</button>
                              <div class="text-center">
                                <a class="small" href="#">Forgot password?</a></div>
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