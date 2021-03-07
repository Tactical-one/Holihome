<?php
include("../connection.php");

/*
//code to validate if user is logged in
function isLoggedIn(){
	if (isset($_SESSION['admin'])){
		return true;
	}else{
		return false;
	}
}

if (!isLoggedIn()){
	$_SESSION['msg'] = "You must log in first.";
	header('Location:index.php');
}
*/


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
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/custom2.css" rel="stylesheet" />
    </head>

    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">HoliHome</a>
               <!-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>   -->
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                      <!--  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>         -->
                      <!--  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">Register</a></li>   -->
                      <!--  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup">Log In</a></li>          -->
                    </ul>
                </div>
            </div>
        </nav>
                <!-- nav end -->

                <main>


    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">

                <!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img id="avatar" src="../assets/img/avatar profile.jpg" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->

					<div class="profile-usertitle-name">
					<?php 
						echo $_SESSION ['admin'];
						
						?>
					
					</div>
					<div class="profile-usertitle-job">
						Admin
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->

				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<!--<button type="button" class="btn btn-success btn-sm">Follow</button> -->
					<button type="button" class="btn btn-danger btn-sm"><a href="logout.php" style="color:white;"> Log out </a></button>
				</div>
				<!-- END SIDEBAR BUTTONS -->

				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav_dash">
						<li class="active">
							<a href="host-dashboard.php">
							<i class="glyphicon glyphicon-home"></i>
							Dashboard </a>
						</li>
                        <li>
							<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							Disable an Account </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="glyphicon glyphicon-ok"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-flag"></i>
							Help </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>

        <!-- right section -->
		<div class="col-md-9">
            <div class="profile-content">
			   <h3> Welcome!!</h3>

               <!-- cards  -->
               <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                   <!-- card1 -->
    <div class="col">
      <div class="card mb-4 shadow-sm">
      <div class="card-header" style="background-color:#64a19d;">
      <i class="fa fa-user-friends"></i>
        <h4 class="my-0 fw-normal">Users</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">

        <?php 
                $sql = "SELECT COUNT('user_ID') FROM users";
                $result = mysqli_query($db, $sql);
                $row = mysqli_fetch_array($result);
                echo "$row[0]";
                
                ?>

        </h1> 
      </div>
    </div>
    </div>

    <!-- card2 -->
    <div class="col">
      <div class="card mb-4 shadow-sm">
      <div class="card-header">
      <i class="fa fa-home"></i>
        <h4 class="my-0 fw-normal">Properties </h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">

        <?php 
                $sql = "SELECT COUNT('property_ID') FROM property";
                $result = mysqli_query($db, $sql);
                $row = mysqli_fetch_array($result);
                echo "$row[0]";
                
                ?>

        </h1>
      </div>
    </div>
    </div>

    <!-- card3 -->
    <div class="col">
      <div class="card mb-4 shadow-sm">
      <div class="card-header" style="background-color:#64a19d;">
      <i class="fa fa-handshake"></i>
        <h4 class="my-0 fw-normal">Bookings</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">

        <?php 
                $sql = "SELECT COUNT('booking_ID') FROM booking";
                $result = mysqli_query($db, $sql);
                $row = mysqli_fetch_array($result);
                echo "$row[0]";
                
                ?>
        </h1>
      </div>
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
<script src="../js/scripts.js"></script>

    </body>
        </html>