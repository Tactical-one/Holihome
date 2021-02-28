<?php
include("connection.php");

// Sign in 
if (isset($_POST['signin'])){
	$email = $_POST["email"];
	$password = $_POST["password"];

	if(empty($email) || empty($password)){ 
		$msg = "Both fields must be entered!!";
	}else{
		$sql = "SELECT host_ID FROM hosts WHERE email='$email' AND password='$password'";
		$result = mysqli_query($db,$sql);

		if(mysqli_num_rows($result) == 1){
			$_SESSION['host_id'] = $email;
			header("Location:host-dashboard.php");
		}else{
			$msg = "Incorrect email or password!";
		}
	}
}

//Register 
if(isset($_POST['signup'])){
	$nameErr = $emailErr = $passwordErr = $rep_passwordErr = $msg1 = "";
	
	$firstname = $lastname = $email = $tel = $password = $rep_password = "";
  
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
	}else{
		$email = $_POST["email"];
	}

	$tel = $_POST["tel"];

  
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

  if(empty($emailErr) && empty($passwordErr) && empty($rep_passwordErr) && empty($msg1)){
  	$user_check_query = "SELECT * FROM hosts WHERE email = '$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if($user['email'] === $email){
    $msg1 = "Email already exists!";
  }else{
	$sql = "INSERT INTO hosts (firstname, lastname, email, tel, password)
			VALUES ('$firstname', '$lastname', '$email', '$tel', '$password')";
  
			mysqli_query($db, $sql);
			$_SESSION['host_id'] = $email;
			header("Location:dashboard.php");
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

               <!-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>         
                       <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">Register</a></li>       
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup">Log In</a></li>          
                    </ul>   -->
                </div>
            </div>
        </nav>
<!--Nav End-->

        <main>
        <div class="login-wrap">
	<div class="login-html">
	<p style="color:red;"><?php if(isset($msg1)){echo $msg1;} ?></p>
	
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>

		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Register</label>
		
		<div class="login-form">
		
                                <!-- Register -->
	<form id="register" method="post" action="">
        <div class="sign-up-htm">       
				<div class="group">
					<label for="user" class="label">Firstname</label>
					<input id="user" type="text" class="input" value="<?php if(isset($firstname)){echo $firstname;} ?>" name="firstname">

					<span style="color:red;"><?php if(isset($nameErr)){echo $nameErr;} ?></span>
				</div>

                <div class="group">
					<label for="user" class="label">Lastname</label>
					<input id="user" type="text" class="input" value="<?php if(isset($lastname)){echo $lastname;} ?>" name="lastname">

					<span style="color:red;"><?php if(isset($nameErr)){echo $nameErr;} ?></span>
				</div>

                <div class="group">
					<label for="pass" class="label">Email Address</label>
					<input id="pass" type="email" class="input" value="<?php if(isset($email)){echo $email;} ?>" name="email" >

					<span style="color:red;"><?php if(isset($emailErr)){echo $emailErr;} ?></span>
				</div>

				<div class="group">
					<label for="tel" class="label">Tel</label>
					<input id="phone" type="tel" class="input" minlength="3" name="tel" value="<?php if(isset($tel)){echo $tel;} ?>">
				</div>

				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password" minlength="3" name="password" >

					<span style="color:red;"><?php if(isset($passwordErr)){echo $passwordErr;} ?></span>
				</div>

				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="pass" type="password" class="input" data-type="password" minlength="3" name="rep_password" >

					<p style="color:red;"><?php if(isset($rep_passwordErr)){echo $rep_passwordErr;} ?></p>
				</div>

				<div class="group">
					<input type="submit" class="button" value="Sign Up" name="signup">
				</div>
	</form>

				<div class="hr"></div>
			</div>

                            <!-- Sign in -->
		
			<div class="sign-in-htm">
		<form id="signin" method="post" action="">
            <div class="group">
					<label for="pass" class="label">Email Address</label>
					<input id="pass" type="text" class="input" name="email" value="<?php if(isset($email)){ echo $email;} ?>" required>
				</div>

				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password" name="password">
				</div>

				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>

				<div class="group">
					<input type="submit" class="button" value="Sign In" name="signin">
				</div>

				<p style="color:red;"><?php if(isset($msg)){print $msg; }?></p>

			</form>
				<div class="hr"></div>

				<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
				</div>
			</div>
		</div>
	</div>
</div>


        </main>


<!-- Footer-->

<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>


</body>
    </html>