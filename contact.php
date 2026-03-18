<?php 
require('db.php');

$sql = "SELECT * FROM contact";
$contact_list = mysqli_query($conn, $sql);

$update_id = ""; $user_details = array(); $prev_list = array(); $prev_id = "";

// // if(isset($_REQUEST['update_id'])) {
// //   $update_id = $_REQUEST['update_id'];

//    if(!empty($update_id)) {
    $update_id = 1;
    $update_sql = "SELECT * FROM contact  WHERE id='$update_id'";

    if(!empty($update_sql)) {
      $user_details = $conn->query($update_sql);
    }

    if(!empty($user_details)) {
        foreach($user_details as $data) {
          $update_name = $data['res_name'];
          $update_address = $data['res_address'];
          $update_mobile = $data['res_mobile'];
          $update_email = $data['res_email'];
        }
    }
//   }
// // }

$name = ""; $name_error = ""; $error = 0; $mobile = ""; $mobile_error = ""; $email = ""; $email_error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['update_id'])) {
        $update_id=$_POST['update_id'];
      }
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }
    if(empty($name)) {
        $name_error = "Enter Restaurant Name";
        $error = 1;
    } else {
        if(!preg_match('/^[a-zA-z\s]+$/', $name)) {
        $name_error = "Invalid Name"; 
        $error = 1;
        }
    }

    if(isset($_POST['address'])){
        $address = $_POST['address'];
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

    if(isset($_POST['mail'])){
        $email=$_POST['mail'];
    }
    if(empty($email)){
        $email_error = "Enter Restaurant Email";
        $error=1;
    }else{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {      
        $email_error = $email . " is not a valid email address";
        $error = 1;
    }
    }
    if($error == 0){
        if(empty($update_id)) {
            $sql = "INSERT INTO contact  (res_name, res_address, res_mobile, res_email)
            VALUES ('$name', '$address', '$mobile', '$email')";
            if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
            //   header("Location: formlist.php");
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
        } 
        else {
          $sql = "UPDATE contact  SET res_name = '$name', res_address = '$address', res_mobile = '$mobile', res_email = '$email' WHERE id='$update_id' ";
          if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
            // header("Location: formlist.php");
    
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
          
        }
        
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
    <title>Dashboard</title>
    <style>
        .b1{background-color: #ec4343; padding: 5px 0px 265px;}
        .dash{margin: 0; padding: 0; }
        .dash li{list-style: none;font-size: 20px; padding-top: 10px;}
        .dash li a{color:white;padding-left: 10px;}
        .dash li a:hover{text-decoration: none;}
        .bo{padding: 0; margin: 0;}
        .dropdown  a{color:white;padding-left: 10px; font-size: 20px;}
        .dropdown  a:hover{text-decoration: none;}
        .dropdown-menu.show {background: #ec4343;color: white;}
        .stat{text-align: center; padding: 10px 0px;}
        .con{font-size: 18px; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;}
        .fam{padding-left: 20px;}
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
                        <li><a href="tablelist.php">Table</a></li>
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
            <div class="col-lg-9 con">
                <h3 class="text-center py-4">Restaurant Contact Details</h3>
                <div class="fam">
                    <form action="contact.php" method="POST">
                        <input type="hidden" name="update_id" value='<?php if(!empty($update_id)) { echo $update_id; } ?>'>
                        Restaurant Name: <input type="text" name="name" value='<?php if(!empty($update_name)) { echo $update_name; } ?>'><br><br>
                        <span style="color:red" ><?php if(!empty($name_error)) { echo $name_error; } ?></span><br>                      
                        Address: <textarea name="address" rows="3" cols="30"><?php if(!empty($update_address)) { echo $update_address; } ?></textarea><br><br>
                        Mobile Number: <input type="text" maxlength="10" name="mobile" value='<?php if(!empty($update_mobile)) { echo $update_mobile; } ?>'><br><br>
                        <span style="color:red" ><?php if(!empty($mobile_error)) { echo $mobile_error; } ?></span><br>
                        Email: <input type="text" name="mail" id="mail" value='<?php if(!empty($update_email)) { echo $update_email; } ?>'><br><br>
                        <span style="color:red" ><?php if(!empty($email_error)) { echo $email_error; } ?></span><br>
                        <input type="submit" name="submit" id="submit" value="UPDATE" class="btn btn-danger">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>