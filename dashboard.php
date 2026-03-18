<?php
session_start();
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
        /* .hr{color: #ec4343; border: 2px solid;} */
    </style>
</head>
<body>
<?php
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {?>

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
                        <h3 class="text-center">Admin Dashboard</h3>
                    </div>
                </div>
            </div>
        <?php }
    }      
?>
  
</body>
</html>