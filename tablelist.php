<?php
session_start();

require('db.php');

$delete_id = ""; $delete_details = array();

$sql = "SELECT * FROM tablename";
$table_list = mysqli_query($conn, $sql);

if(isset($_REQUEST['delete_id'])) {
    $delete_id = $_REQUEST['delete_id'];
  
    if(!empty($delete_id)) {
      $delete_sql = "DELETE FROM tablename  WHERE table_id='$delete_id' ";
  
      if(!empty($delete_sql)) {
        $delete_details = $conn->query($delete_sql);
        echo "Record Deleted Successfuly";
        header("Location: tablelist.php");
      }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
                <h3 class="text-center py-4">Table List</h3>
                <form action="tablelist.php" method="POST">
                    <a href="tablename.php" class="btn btn-outline-danger my-3">ADD</a>
                    <table class = "table table-hover">
                        <thead>
                            <tr>
                                <th scope = "col">S.No</th>
                                <th scope = "col">Table Name</th>
                                <th scope = "col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($table_list)) {
                                    foreach($table_list as $data) { ?>
                                        <tr>
                                            <td><?php if(!empty($data['table_id'])) { echo $data['table_id']; } ?></td>
                                            <td><?php if(!empty($data['table_num'])) { echo $data['table_num']; } ?></td>
                                            <td>
                                                <a href ="tablename.php?update_id=<?php echo $data['table_id']; ?>"class = "btn btn-danger">UPDATE</a>
                                                <a href="tablelist.php?delete_id=<?php echo $data['table_id'] ?>" class = "btn btn-danger">DELETE</a>
                                            </td>

                                        </tr>
                                <?php  }
                                }
                            
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>