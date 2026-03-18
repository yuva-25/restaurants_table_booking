<?php
require('db.php');
$sql = "SELECT *  FROM tablebooking";
$search_list = mysqli_query($conn, $sql);
if(!empty($search_list)){
  foreach($search_list as $list){
    $id=$list['id'];
  }
}

 
$search = ""; $search_error = ""; $error = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['search'])){
    $search=$_POST['search'];
  }

  if(empty($search)){ 
    $search_error = "ENTER BOOKING NUMBER";
    $error = 1;
  }
  
  // if(!empty($search)){
  //   $Search_query = "SELECT * FROM  tablebooking WHERE book_no='$search'";
  //   if(!empty($Search_query)) {
  //     $search_deatils = $conn->query($Search_query);
  //   }

  //   if(!empty($search_deatils)){
  //     foreach($search_deatils as $data){
      
  //       echo "<h2>Booking Details</h2>";
  //       echo "<p><strong>Name:</strong> " . $data['cus_name'] . "</p>";
  //       echo "<p><strong>Mobile Number:</strong> " . $data['mobile_number'] . "</p>";
  //       echo "<p><strong>Address:</strong> " . $data['cus_address'] . "</p>";
  //       echo "<p><strong>Adult:</strong> " . $data['no_adult'] . "</p>";
  //       echo "<p><strong>Child:</strong> " . $data['no_child'] . "</p>";
  //       echo "<p><strong>Total Person:</strong> " . $data['toatl_ppl'] . "</p>";
  //       echo "<p><strong>Booking Date:</strong> " . $data['book_date'] . "</p>";
  //       echo "<p><strong>Booking Number:</strong> " . $data['book_no'] . "</p>";
  //         // echo "<p>No booking found for the given number.</p>";
  //     }
  //   }else {
  //     echo "<p>No booking found for the given number.</p>";
  //   }
  // } 
      
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
    <title>Search</title>
    <style>
      .se button{background-color: #ec4343; border:none; padding: 10px 15px; border-radius: 50%;}
      .se button i{color: white; font-size: 20px;}
      .se input[type='text']{padding: 10px 20px; border: 1px solid #ec4343;}
      .det{padding:  10px 20px; }
      .det h2{color: #ec4343; padding-bottom: 15px;}
      /* .det:hover{background-color: #d9d4d470; border-radius: 30px 0px 30px 0px; border: 1px dashed #ec4343;} */
      /* .bg3{background-color: gray;} */
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
            <li class="nav-item">
                <a class="nav-link" href="homecontact.php">Contact</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="search.php">Search History</a>
              </li>
          </ul>
          <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="my-2 my-sm-0" type="submit" name="search"><i class="bi bi-search"></i></button>
          </form> -->
        </div>
    </nav>
    <form action="search.php" method="POST">
      <div class="bg3">
        <div class="container my-5">
          <div class="row justify-content-center">
            <div class="col-lg-9">
            <div class="se">
              <input type="text" name="search" id="search" placeholder="SEARCH BOOKING NUMBER">
              <button type="submit" name="submit"><i class="bi bi-search"></i></button><br>
              <span style="color:red" ><?php if(!empty($search_error)) { echo $search_error; } ?></span><br><br><br>
              <div class="det tex-center">
              <?php if(!empty($search)){
                $Search_query = "SELECT * FROM  tablebooking WHERE book_no='$search'";
                if(!empty($Search_query)) {
                  $search_deatils = $conn->query($Search_query);
                }

                if(!empty($search_deatils)){
                  foreach($search_deatils as $data){ ?>
                  <div class="col-lg-9 text-center pb-4"> 
                    <a href="searchdetails.php?print_id=<?php echo $data['id']; ?>" target="_blank" class = "btn btn-danger">PDF</a> 
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Name</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['cus_name']; ?></h5><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Mobile Number</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['mobile_number']; ?></h5><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Address</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['cus_address']; ?></h5><br>
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Adult</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['no_adult']; ?></h5><br>
                    </div>
                  </div> 

                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Child</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['no_child']; ?></h5><br>
                    </div>
                  </div> 

                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Total Person</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['toatl_ppl']; ?></h5><br>
                    </div>
                  </div> 

                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Booking Date</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['book_date']; ?></h5><br>
                    </div>
                  </div> 

                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Booking Number</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['book_no']; ?></h5><br>
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Booking Table Status</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['cus_status']; ?></h5><br>
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-lg-4">
                      <h5>Remarks</h5>
                    </div>
                    <div class="col-lg-4 text-right">
                      <h5>:</h5>
                    </div>
                    <div class="col-lg-4">
                      <h5><?php echo $data['cus_remarks']; ?></h5><br>
                    </div>
                  </div> 
                  <?php
                  
                  
                    // echo ">";
                    // echo "<h6><strong>Name </strong> " . $data['cus_name'] . "</h6><br>";
                    // echo "<h6><strong>Mobile Number: </strong> " . $data['mobile_number'] . "</h6><br>";
                    // echo "<h6><strong>Address: </strong> " . $data['cus_address'] . "</h6><br>";
                    // echo "<h6><strong>Adult: </strong> " . $data['no_adult'] . "</h6><br>";
                    // echo "<h6><strong>Child: </strong> " . $data['no_child'] . "</h6><br>";
                    // echo "<h6><strong>Total Person: </strong> " . $data['toatl_ppl'] . "</h6><br>";
                    // echo "<h6><strong>Booking Date: </strong> " . $data['book_date'] . "</h6><br>";
                    // echo "<h6><strong>Booking Number: </strong> " . $data['book_no'] . "</
                    // h6><br>";
                      // echo "<p>No booking found for the given number.</p>";
                  }
                }else {
                  echo "<p>No booking found for the given number.</p>";
                }
              } 
              ?>    
              </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </form>
    
</body>
</html>

