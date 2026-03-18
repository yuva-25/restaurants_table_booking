<?php
// session_start();

require('db.php');

$update_id = ""; $user_details = array(); $prev_list = array(); $prev_id = "";

if(isset($_REQUEST['update_id'])) {
  $update_id = $_REQUEST['update_id'];

  if(!empty($update_id)) {
    $update_sql = "SELECT * FROM tablename WHERE table_id='$update_id'";

    if(!empty($update_sql)) {
      $user_details = $conn->query($update_sql);
    }

    if(!empty($user_details)) {
        foreach($user_details as $data) {
          $update_name = $data['table_num'];
        }
    }
  }
}

$table_name = ""; $table_error = ""; $error = 0;
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(isset($_POST['tabname'])){
        $table_name = $_POST['tabname'];
    }
    if(empty($table_name)){
        $table_error = "Enter Table Name";
        $error = 1;
    }else{
        if(!preg_match('/^[0-9A-Z]{2}$/', $table_name)) {
            $table_error = "Invalid Table Name";
            $error = 1;
        }
    }
    if(!empty($table_name)) {
        $sql = "SELECT table_id FROM tablename WHERE table_num ='$table_name'";
    
        if(!empty($sql)) {
          $prev_list = $conn->query($sql);
        }
    
        if(!empty($prev_list)) {
          foreach($prev_list as $list) {
            $prev_id = $list['table_id'];
          }
        }
    
        if($prev_id != "" && $prev_id != $update_id) {
          $table_error = "This Table Name is Already Exists";
          $error = 1;
        }
    }
    
    if($error == 0){
        if(empty($update_id)){
            $sql = "INSERT INTO tablename (table_num)
            VALUES('$table_name')";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
                header("Location: tablelist.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }else {
            $sql = "UPDATE tablename SET table_num = '$table_name' WHERE table_id='$update_id' ";
            if (mysqli_query($conn, $sql)) {
              echo "Record updated successfully";
              header("Location: tablelist.php");
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }   
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
    <title>Table Name</title>
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
        <div class="col-lg-9">
          <h3 class="text-center py-4">Table Name</h3>
          <form action="tablename.php" method="POST">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-lg-4">
                        <!-- <h3 class="my-3 text-center">Table Name</h3> -->
                          <input type="hidden" name="update_id" value='<?php if(!empty($update_id)) { echo $update_id; } ?>'><br><br>
                        Table Name:  <input type="text" name="tabname" id="tabname" value="<?php if(!empty($update_name)){ echo $update_name; }?>"><br><br>
                        <span style="color:red" ><?php if(!empty($table_error)) { echo $table_error; } ?></span><br><br>
                        <center><input type="submit" name="submit" value="SUBMIT" class="btn btn-danger"></center>
                      </div>
                  </div>
              </div>
          </form>
        </div>
    </div>
  </div>
  
    
</body>
</html>