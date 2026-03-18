<?php
// session_start();
require('db.php');

$update_id = ""; $user_details = array();

if(isset($_REQUEST['update_id'])){
    $update_id = $_REQUEST['update_id'];

    if(!empty($update_id)){
        $update_sql = "SELECT * FROM  tablebooking  WHERE id='$update_id'";

        if(!empty($update_sql)){
            $user_details = $conn->query($update_sql);
        }

        if(!empty($user_details)) {
            foreach($user_details as $data) {
            $update_name = $data['cus_name'];
            $update_mobile = $data['mobile_number'];
            $update_address = $data['cus_address'];
            $update_adult = $data['no_adult'];
            $update_child = $data['no_child'];
            $update_date = $data['book_date'];
            $update_booking = $data['book_no'];
            $update_status = $data['cus_status'];
            $update_remark = $data['cus_remarks'];
            }
        }
    }

}

$status=""; $remark=""; $booking_no="";
if($_SERVER["REQUEST_METHOD"] == 'POST'){
   
    if(isset($_POST['update_id'])){
        $status=$_POST['update_id'];
    }
    if(isset($_POST['status'])){
        $status=$_POST['status'];
    }
    if(isset($_POST['remark'])){
        $remark=$_POST['remark'];
    }

    $sql = "UPDATE tablebooking SET cus_status = '$status', cus_remarks  = '$remark' WHERE id='$update_id'";
    if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
    header("Location: bookinglist.php");
    } else {
    echo "Error updating record: " . mysqli_error($conn);
    }   

}


// echo $status;
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
    <title>Dashboard</title>
    <style>
        .b1{background-color: #ec4343; padding: 5px 0px 265px;}
        .dash{margin: 0; padding: 0; }
        .dash li{list-style: none;font-size: 20px; padding-top: 10px;}
        .dash li a{color:white;padding-left: 10px;}
        .dash li a:hover{text-decoration: none;}
        .dropdown  a{color:white;padding-left: 10px; font-size: 20px;}
        .dropdown  a:hover{text-decoration: none;}
        .dropdown-menu.show {background: #ec4343;color: white;}
        .bo{padding: 0; margin: 0;}
        .stat{text-align: left; padding: 10px 0px;}
    </style>
</head>
<body>
    <div class="container-fluid da">
        <div class="row">
            <div class="col-lg-3 bo">
                <div class="b1">
                    <ul class="dash">
                        <h3 class="pt-3" style="color: black;">DASHBOARD</h3>
                        <hr>
                        <li><a href="table.php">Table</a></li>
                        <hr>
                        <div class="dropdown">
                            <a href="bookinglist.php" class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                Booking
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="bookinglist.php">Pending List</a>
                                <a class="dropdown-item" href="approvedlist.php">Approved List</a>
                                <a class="dropdown-item" href="rejectedlist.php">Rejected List</a>
                            </div>
                        </div>
                        <hr>
                        <li><a href="report.php">Report</a></li>
                        <hr>
                        <li><a href="contact.php">Contact</a></li>
                        <hr>    
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 pl-5">
                <h3 class="text-center py-2">Booking Update</h3>
                <form action="booking_update.php" method="POST">
                    <input type="hidden" name="update_id" value='<?php if(!empty($update_id)) { echo $update_id; } ?>'><br><br>
                    Name: <input type="text" id="name" name="name" value='<?php if(!empty($update_name)) { echo $update_name; } ?>'><br>
                    <span style="color:red" ><?php if(!empty($name_error)) { echo $name_error; } ?></span><br>
                    Mobile: <input type="text" name="mobile" id="mobile" maxlength="10" value='<?php if(!empty($update_mobile)) { echo $update_mobile; } ?>'><br>
                    <span style="color:red" ><?php if(!empty($mobile_error)) { echo $mobile_error; } ?></span><br>
                    Address: <textarea name="address" rows="5" cols="40"><?php if(!empty($update_address)) { echo $update_address; }?></textarea><br><br>
                    <div class="stat">
                        <select name="status" id="status" class="btn btn-danger">
                            <option value="">Status</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select><br><br>
                        Remarks: <input type="text" name="remark" id="remark"><br><br>
                        <input type="submit" value="Update" name="submit" class="btn btn-danger"><br><br>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>