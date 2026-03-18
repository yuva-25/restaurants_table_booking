<?php
require('db.php');
$sql = "SELECT * FROM  tablebooking";
$report_list = mysqli_query($conn, $sql);


$selected_to_date = "";
$selected_to_date = date('Y-m-d');


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
                <h3 class="text-center py-4">Report</h3>
                <form action="report.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-lg-2">
                            <input type="date" name="from_date" id="from_date" onchange="getreport()" class = "btn btn-outline-danger" value="<?php if(!empty($selected_from_date)){ echo $selected_from_date;}?>">
                        </div>
                        <div class="col-lg-3 pb-5">
                            <input type="date" name="to_date" id="to_date" onchange="getreport()" class = "btn btn-outline-danger" value="<?php if(!empty($selected_to_date)){ echo $selected_to_date; }?>">
                        </div>
                    </div>
                    <table class = "table table-hover">
                        <thead>
                            <tr>
                                <th scope = "col">S.No</th>
                                <th scope = "col">Booking Date</th>
                                <th scope = "col">Customer Name</th>
                                <th scope = "col">Mobile Number</th>
                                <th scope = "col">Customer Address</th>
                                <th scope = "col">Status</th>
                            </tr>
                        </thead>
                        <tbody id="report">
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function getreport(){

        // var selected_to_date = date('Y-m-d');
        var from_date = ""; var to_date = ""; 
        if($('#from_date').length > 0){
            from_date = $('#from_date').val();
        }

        if($('#to_date').length > 0){
            selected_to_date = $('#to_date').val();
        }
        var post_url = "reportchange.php?selected_from_date="+from_date+"&selected_to_date="+selected_to_date;

        $.ajax({ url:post_url, success:function(result){
            if($("#report").length > 0) {
                $("#report").html(result);
            }
        }});
    }
</script>
