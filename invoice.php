
<?php
include("connection.php");

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

$sql = "SELECT * FROM invoice ORDER BY booking_ID DESC LIMIT 1";
$result = mysqli_query($db, $sql);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);

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

    <body>

        <div class="container">

            <div class="page-header">
                <h1>HoliHome</h1>
            </div>
            
            <!-- Simple Invoice - START -->
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        
                        <hr>
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6 pull-left">
                                <div class="panel panel-default height">
                                    <div class="panel-heading">Billing Details</div>
                                    <div class="panel-body">
                                        <strong>Name:</strong> <?php echo $row['firstname'] . ' ' . $row['lastname']; ?> <br>

                                        <strong> Date of Booking: </strong> <?php echo $row['dateofbooking']; ?> 
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-md-3 col-lg-3">
                                <div class="panel panel-default height">
                                    <div class="panel-heading">Order Preferences</div>
                                    <div class="panel-body">
                                        <strong>Insurance:</strong> No<br>
                                        <strong>Coupon:</strong> No<br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-3 col-lg-3">
                                <div class="panel panel-default height">
                                    <div class="panel-heading">Date</div>
                                    <div class="panel-body">
                                        <strong>From:</strong> <?php echo $row['startdate']; ?> <br>
                                        <strong>To:</strong> <?php echo $row['enddate']; ?> <br>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="text-center"><strong>Booking Summary</strong></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <td><strong>Property Name</strong></td>
                                                <td class="text-center"><strong>Location</strong></td>
                                                <td class="text-center"><strong>Number of Days</strong></td>
                                                <td class="text-right"><strong>Cost</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <?php echo $row['selectedproperty']; ?> </td>
                                                <td class="text-center"> <?php echo $row['location']; ?> </td>
                                                <td class="text-center"> <?php echo $row['numberofdays']; ?>  </td>
                                                <td class="text-right"> £<?php echo $row['cost']; ?> </td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="highrow"></td>
                                                <td class="highrow"></td>
                                                <td class="highrow text-center"><strong>Subtotal</strong></td>
                                                <td class="highrow text-right"> £<?php echo $row['cost']; ?> </td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                                <td class="emptyrow"></td>
                                                <td class="emptyrow text-center"><strong>Total</strong></td>
                                                <td class="emptyrow text-right">£<?php echo $row['cost'] * $row['numberofdays']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <p style="float: right;">Click <a href="dashboard.php">here</a> to go back to dashboard</p>
            </div>

    </body>
    </html>