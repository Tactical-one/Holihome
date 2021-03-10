<?php

$sql = "SELECT * FROM property ORDER BY property_ID DESC";
$result = mysqli_query($db, $sql);
if(mysqli_num_rows($result) > 0){ $c = 0;
  while($row = mysqli_fetch_assoc($result)){ ?>


 <!-- Card Start -->
 <div class="container py-3">
  <div class="card">
    <div class="row ">

      <div class="col-md-6 px-3">
        <div class="card-block px-6">
          <h4 class="card-title"><?php echo $row['propertyname'];?> </h4>
          <p class="card-text">
            <?php echo $row['property_desc'];?>
          </p>
          <p class="card-text"><i class="fa fa-tag"></i><b> £ <?php echo $row['cost'];?> </b></p>
          <p class="card-text"><i class="fas fa-map-marker-alt"></i><b> <?php echo $row['location'];?> </b></p>
          <br>
         <!-- <a  class="mt-auto btn btn-primary" href="booking-confirmation-form.php">Book now</a> -->
        </div>
      </div>
      <!-- Carousel start -->
      <div class="col-md-6">
        <div id="CarouselTest" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#CarouselTest" data-slide-to="0" class="active"></li>
            <li data-target="#CarouselTest" data-slide-to="1"></li>
            <li data-target="#CarouselTest" data-slide-to="2"></li>

          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block" src="upload/<?php echo $row['image'];?>" alt="property">
            </div>
            <div class="carousel-item">
              <img class="d-block" src="upload/<?php echo $row['image'];?>" alt="property">
            </div>
            <div class="carousel-item">
              <img class="d-block" src="upload/<?php echo $row['image'];?>" alt="property">
            </div>
            <a class="carousel-control-prev" href="#CarouselTest" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
            <a class="carousel-control-next" href="#CarouselTest" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
          </div>
        </div>
      </div>
      <!-- End of carousel -->
    </div>
  </div>
  <!-- End of card -->

</div>

<?php $c++; }}else{
  $msg = "[No Uploads Available]"; ?>

  <h3 style="color:red;"><?php echo $msg;} ?></h3>