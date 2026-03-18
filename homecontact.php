<?php
require('db.php');

$sql = "SELECT * FROM contact";
$contact_list = mysqli_query($conn, $sql);
$name=""; $address=""; $mobile=""; $email="";
if(!empty($contact_list)){
    foreach($contact_list as $list){
        $name=$list['res_name'];
        $address=$list['res_address'];
        $mobile=$list['res_mobile'];
        $email=$list['res_email'];
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Contact</title>
    <style>
        /* .bg2{background-image: url('../images/contact3.jpg');background-size: cover;background-repeat: no-repeat;background-attachment: scroll;position: relative;margin: 0px 0px 50px;background-position: center; padding: 100px 100px 300px;}
        .bg2::before{background: black fixed repeat none 0 0;content: "";width: 100%; height: 100%; opacity: 0.4;position: absolute;left: 0;top: 0;}
        .ico i{background-color: #ec4343; color: white; padding: 20px; border-radius: 100%;}
        .ico{font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; border: 1px solid #ec4343; padding: 30px 10px; margin-bottom: 20px; border-radius: 20px 0px 20px 0px;}
        .ico1 i{background-color: #ec4343; color: white; padding: 20px; border-radius: 100%;}
        .ico1{font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; border: 2px dashed #ec4343; padding: 30px 10px; margin-bottom: 20px;} */
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Restaurant Table Booking</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="home.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="booking.php">Book Now</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="login.php">Admin</a>
            </li> -->
            <li class="nav-item active">
                <a class="nav-link" href="homecontact.php">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="search.php">Search History</a>
              </li>
          </ul>
          <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="my-2 my-sm-0" type="submit" name="search"><i class="bi bi-search"></i></button>
          </form> -->
        </div>
    </nav>
    <div class="bg2">
        <div class="container-fluid text-center">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="gill text-center" style="color: white; font-weight: 900;">Contact Us</h1>
              <!-- <h2 class="segoe ma">Management System</h2> -->
            </div>
          </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6">
                <div class="ico">
                    <h5 class="lucida"><i class="bi bi-building-fill"></i>  <?php echo $name; ?></h5>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ico1">
                    <h5 class="lucida"><i class="bi bi-geo-alt-fill lo"></i> <?php echo $address; ?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6">
                <div class="ico1">
                    <?php ?><h5 class="lucida"><i class="bi bi-telephone-fill"></i>  <?php echo $mobile; ?></h5>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ico">
                    <h5 class="lucida"><i class="bi bi-envelope-at-fill"></i> <?php echo $email; ?></h5>
                </div>
            </div>
        </div>
    </div>
</body>
</html>