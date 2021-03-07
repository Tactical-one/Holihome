<?php
include("connection.php");

/*
//code to validate if user is logged in
function isLoggedIn(){
	if (isset($_SESSION['user_id'])){
		return true;
	}else{
		return false;
	}
}

if (!isLoggedIn()){
	$_SESSION['msg'] = "You must log in first.";
	header('Location:login.php');
}
*/

if (isset($_POST['submit'])){

    $firstname = mysqli_real_escape_string($db, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($db, $_POST["lastname"]);
    $selectedproperty = $_POST["selectedproperty"];
    $startdate = $_POST["startdate"];
    $enddate = $_POST["enddate"];

    //number of days calc
    $date1 = date_create("$startdate");
    $date2 = date_create("$enddate");

    $interval = date_diff($date1, $date2);
    $numberofdays = $interval->format('%a');

      //get current date and time
    $t = time();
    $date = date("Y-m-d H:i", $t);

    if(empty($firstname) || empty($lastname) || empty($selectedproperty)){
        $msg = "All fields must be entered!";
    }elseif(empty($startdate) || empty($enddate)){
        $msg = "Please Provide booking dates!";
    }else{
        $sql = $db ->prepare("INSERT INTO booking (firstname, lastname, selectedproperty, startdate, enddate, numberofdays, dateofbooking) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $sql -> bind_param("sssssis", $firstname, $lastname, $selectedproperty, $startdate, $enddate, $numberofdays, $date);
        $sql -> execute();

        if(mysqli_query($db, $sql)){
            $msg1 = 'Booking successful! Please click <a href="invoice.php"> here </a> to generate invoice';
        }else{
            $msg = "Booking Failed, Please try again";
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
        <link href="css/custom2.css" rel="stylesheet" />
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
					<img id="avatar" src="assets/img/avatar profile.jpg" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->

					<div class="profile-usertitle-name">
                    <?php 
						echo $_SESSION ['user_id'];
						
						?>
					
					</div>
					<div class="profile-usertitle-job">
						User
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm"><a href="logout.php" style="color:white;">Log out</a></button>
				</div>
				<!-- END SIDEBAR BUTTONS -->

				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav_dash">
						<li>
							<a href="dashboard.php">
							<i class="glyphicon glyphicon-home"></i>
							Properties </a>
						</li>
						<li class="active">
							<a href="booking-confirmation-form.php">
							<i class="glyphicon glyphicon-user"></i>
							Booking </a>
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
            <div class="profile-content" style="margin-left:65px;">
			   <h3> Welcome!!</h3>
               Your booking awaits....<br/>
               <P></P>
               <p style="color:red;"><?php if (isset($msg)){echo $msg;} ?> </p>

               <p style="color:green;"><?php if (isset($msg1)){echo $msg1;} ?> </p>

			<!-- Form booking -->
			<form method="post" action="" style="width:500px; margin-top:30px;">
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

    <label for="property">Select Property</label>
    <select id="property" name="selectedproperty">

        <?php 
        $sql = "SELECT propertyname FROM property ORDER BY property_ID DESC";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result)> 0){$c= 0;
            while($row = mysqli_fetch_assoc($result)){?>

      <option value="<?php echo $row['propertyname'];?>"><?php echo $row['propertyname'];?></option>
      <?php $c++; }}else{echo "No available data";} ?>

    </select>

    <label for="date">Start Date</label>
    <input type="date" id="startdate" min="2021-01" name="startdate">

    <p></p>
    <label for="date"> End Date</label>
    <input type="date" id="enddate" name="enddate">

     <p></p>
    <input type="submit" value="Submit" name="submit">
  </form>

		</div>
	</div>

                </main>

                
               
<!-- Footer-->
<footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © visitABERDEEN 2021</div></footer>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>

    </body>
        </html>