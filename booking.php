<?php
require('db.php');


$prev_id = ""; $error=0; $name=""; $name_error=""; $mobile=""; $mobile_error=""; $prev_id=""; $address=""; $adult=""; $adult_error=""; $child=""; $child_error=""; $total=""; $total_error=""; $booking_no="";
$date=""; $book_no=""; $book_no_error="";

    $sql = "SELECT id  FROM tablebooking  ORDER BY id DESC LIMIT 1";
    
    if(!empty($sql)) {
        $result = $conn->query($sql);
    }

    if(!empty($result)) {
        foreach($result as $data) {
            $prev_id = $data['id'];
        }
    }

    if(!empty($prev_id)) {
        $current_number = $prev_id + 1;
        $booking_no = "BN/". $current_number;
    } else {
        $booking_no = "BN/1";
    }

    // echo $booking_no."hi";




if($_SERVER["REQUEST_METHOD"] == 'POST'){

    if(isset($_POST['name'])) {
        $name=$_POST['name'];
    }
    
    if(empty($name)) {
        $name_error = "Enter Name";
        $error = 1;
    } else {
        if(!preg_match('/^[a-zA-z\s]+$/', $name)) {
        $name_error = "Invalid Name"; 
        $error = 1;
        }
    }

    if(isset($_POST['mobile'])) {
        $mobile = $_POST['mobile'];
      }
      if(empty($mobile)){
        $mobile_error = "Enter Mobile No";
        $error=1;
      } else{
        if(!preg_match('/^[0-9]{10}+$/', $mobile)){
          $mobile_error = "Invalid Mobile Number";
          $error = 1;
        }
      }
    
      if(!empty($mobile)) {
        $sql = "SELECT id FROM  tablebooking WHERE mobile_number='$mobile'";
    
        if(!empty($sql)) {
          $prev_list = $conn->query($sql);
        }
    
        if(!empty($prev_list)) {
          foreach($prev_list as $list) {
            $prev_id = $list['id'];
          }
        }
    
        if($prev_id != "" && $prev_id != $update_id) {
          $mobile_error = "This Number Already Exists";
          $error = 1;
        }
    }

    
    if(isset($_POST['address'])) {
        $address=$_POST['address'];
    }
   

    if(isset($_POST['adult'])) {
        $adult=$_POST['adult'];
    }
    if(empty($adult)){
        $adult_error="Enter No of Adult";
    }else{
        if(!preg_match('/^[0-9]+$/', $adult)){
          $mobile_error = "Invalid Please Enter in Numbers";
          $error = 1;
        }
    }

    if(isset($_POST['child'])) {
        $child=$_POST['child'];
    }
    if(!empty($child)){
        if(!preg_match('/^[0-9]+$/', $child)){
            $child_error = "Invalid Please Enter in Numbers";
            $error = 1;
        }   
    }else{
        if(empty($child)){
            $child=0;
        }
    }
    
    
    if(isset($_POST['date'])){
        $date=$_POST['date'];
    }
    if(empty($date)){
        $date_error="Select Date";
    }

    if(isset($_POST['number'])){
        $book_no=$_POST['number'];
    }
    
    
    if(!empty($adult) && !empty($child) || !empty($adult) && empty($child)){
        $total = $adult + $child;
    }

    if(!empty($update_id)){
        if(isset($_POST['status'])){
            $status=$_POST['status'];
        }
        if(isset($_POST['remark'])){
            $remark=$_POST['remark'];
        }
    }
    
    
    
    if($error == 0){
            $sql = "INSERT INTO  tablebooking (cus_name, mobile_number, cus_address, no_adult, no_child, toatl_ppl, book_date, book_no)
            VALUES ('$name', '$mobile', '$address', '$adult', '$child', '$total', '$date', '$book_no') ";
            if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
            //   header("Location: formlist.php");
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
       
    }
}


mysqli_close($conn);
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
    <title>Book Now</title>
    <style>
        .bo{padding: 0; margin: 30px 0px 0px;}
        .img1 img{height: auto; border-radius: 10px;}
        .for{font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size: 16px;}
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
            <li class="nav-item active">
            <a class="nav-link" href="booking.php">Book Now</a>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link" href="login.php">Admin</a>
            </li> -->
            <li class="nav-item">
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
    <form action="booking.php" method="POST">
        <h1 class="segoe text-center my-4">Book Your Table Now</h1>
        <div class="container">
            <div class="row bo">
                <div class="col-lg-6">
                    <div class="img1">
                    <img src="images/table1.jpg"  alt="Book" class="img-fluid" title="booking" height="100">
                    </div>
                </div>
                    <div class="col-lg-6 for mt-5">
                    Name: <input type="text" id="name" name="name"><br>
                    <span style="color:red" ><?php if(!empty($name_error)) { echo $name_error; } ?></span><br>
                    Mobile: <input type="text" name="mobile" id="mobile" maxlength="10"><br>
                    <span style="color:red" ><?php if(!empty($mobile_error)) { echo $mobile_error; } ?></span><br>
                    Address: <textarea name="address" rows="5" cols="40"></textarea><br><br>
                    Number of Adults: <input type="text" name="adult" id="adult" onkeyup="gettotal()"><br><br>
                    <span style="color:red" ><?php if(!empty($adult_error)) { echo $adult_error; } ?></span><br>
                    Number of Children: <input type="text" name="child" id="child" onkeyup="gettotal()"><br><br>
                    <span style="color:red" ><?php if(!empty($child_error)) { echo $child_error; } ?></span><br>
                    Total Person: <input type="text" name="total" id="total"><br><br>
                    Booking Date: <input type="date" name="date" id="date"><br><br>
                    <span style="color:red" ><?php if(!empty($date_error)) { echo $date_error; } ?></span><br>
                    Booking Number: <input type="text" name="number" id="number" value="<?php if(!empty($booking_no)){ echo $booking_no;} ?>"><br><br>
                    <span style="color:red" ><?php if(!empty($book_no_error)) { echo $book_no_error; } ?></span><br>
                    <span style="color: red;">Take Note your Booking Number You can See Your Table Booking is Confirm Or not. Go to Search Histoty to Get Your Booking Status</span><br><Br>
                    <input type="submit" name="submit" id="submit" value="SUBMIT" class="btn btn-danger"><br><br>
                </div> 
                    
                
            </div>
        </div>
           
        
    </form>
</body>
</html>

<script>
    numbervalid = /^[0-9]+$/;
    function gettotal(){
        var adult = 0; var child = 0; var toatal = 0; var error = 0;
        if($('span.info').length > 0) {
            $('span.info').remove();
        }
        adult = $('#adult').val();
        child = $('#child').val();
        if(adult != "" && typeof(adult) != undefined){
            if(numbervalid.test(adult) == false){
                if($('#adult').length > 0){
                    $('#adult').after('<span class = "info">Invalid Please Enter in Numbers</span>');
                    error = 1;
                }
            }
        }else{
            if($('#adult').length > 0){
                $('#adult').after('<span class = "info">Enter Rate</span>');
                error = 1;
            }
        }
        if(child != ""  && typeof(child) != undefined){
            if(numbervalid.test(child) == false){
                if($('#child').length > 0){
                    $('#child').after('<span class = "info">Invalid Please Enter in Numbers</span>');
                    error = 1;
                }
            }
        } else {
            child = 0;
        }

        if(error == 0){
                if(typeof(adult) != undefined && typeof(child) != undefined){
                    var total = parseInt(adult) + parseInt(child);
                    $('#total').val(total);
                }
        }
    }

    
</script>