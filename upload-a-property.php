<?php
include("connection.php");

/*
//code to validate if user is logged in
function isLoggedIn(){
	if (isset($_SESSION['host_id'])){
		return true;
	}else{
		return false;
	}
}

if (!isLoggedIn()){
	$_SESSION['msg'] = "You must log in first.";
	header('Location:become-a-host.php');
}

*/

//upload property descriptions
if (isset($_POST['submit'])){
	
	$propertyname = mysqli_real_escape_string($db, $_POST["propertyname"]);
	$location = mysqli_real_escape_string($db, $_POST["location"]);
	$property_desc = mysqli_real_escape_string($db, $_POST["property_desc"]);
	$cost = mysqli_real_escape_string($db, $_POST["cost"]);

	//get image name
	$image = $_FILES['image']['name'];

	//image file directory
	$target = "upload/" .basename($image);

	//check file Size
	/* if($_FILES['image']['size'] > 500000){
		$msg = "File is too large";
	} */

	//Allow certain file formats
	$imageFileType = strtolower(pathinfo($target,PATHINFO_EXTENSION));
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
		$msg1 = "Sorry, only JPG,JPEG, PNG & GIF files are allowed."; 
	}

	//excute query
	if(empty($propertyname) || empty($location)){
		$msg = "All fields must be entered!";
	}elseif(empty($cost)){
		$msg = "Enter cost!";
	}elseif(empty($image)){
		$msg = "All fields must be entered!";
	}elseif($_FILES['image']['size'] > 500000){
		$msg = "File is too large";
	}else{

	$sql = "INSERT INTO property (propertyname, location, property_desc, cost,image) VALUES ('$propertyname', '$location', '$property_desc', '$cost','$image')";

	 if(mysqli_query($db, $sql) && move_uploaded_file($_FILES['image']['tmp_name'], $target)){
		$msg1 = "Upload successful!";
	}else{
		$msg = "Upload failed!!";
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
						Marcus Doe
					</div>
					<div class="profile-usertitle-job">
						Host
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->

				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm"><a href="logout-host.php" style="color:white;"> Log out </a></button>
				</div>
				<!-- END SIDEBAR BUTTONS -->

				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav_dash">
						<li>
							<a href="host-dashboard.php">
							<i class="glyphicon glyphicon-home"></i>
							Dashboard </a>
						</li>
                        <li class = "active">
							<a href="upload-a-property.php">
							<i class="glyphicon glyphicon-user"></i>
							Upload a property</a>
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
			 
			   <!-- upload form -->
			<form method="post" action="" style="width:500px; margin-top:30px;" enctype="multipart/form-data">

    <label for="propertyname">Name of Property</label>
    <input type="text" id="propertyname" name="propertyname" placeholder="Property name.." value="<?php if(isset($propertyname)){echo $propertyname;} ?>">

	<label for="location">Location</label>
    <input type="text" id="location" name="location" placeholder="City, Country" value="<?php if(isset($location)){echo $location;}?>">

	<label for="Desc">Description</label>
    <textarea id="desc" name="property_desc" value="<?php if(isset($property_desc)){echo $property_desc;} ?>" placeholder="Property Description.." style="height:100px; width:100%;"></textarea>

	<label for="cost">Cost(£)</label>
    <input type="text" id="cost" name="cost" placeholder="cost" value="" >
	
	<p></p>
	<input type="file" id="myFile" name="image"> <!--file upload-->
	<p></p>
	<p style="color:red;"><?php if (isset($msg)){echo $msg;} ?> </p>
	<p style="color:green;"><?php if (isset($msg1)){echo $msg1;} ?> </p>

	<p>By uploading a property you agree to our <a href="#" style="color:dodgerblue">Terms</a>.</p>

    <input type="submit" value="Submit" name="submit">
  </form>   

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