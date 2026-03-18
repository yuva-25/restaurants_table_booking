<?php
session_start();

require('db.php');

define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "admin123");

$username = ""; $user_name_error = ""; $password = ""; $password_error = ""; $user_error = ""; $error = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['user_name'])){
        $username = $_POST['user_name'];
    }
    if(empty($username)) {
        $user_name_error = "Enter User Name";
        $error = 1;
    } else {
        if(!preg_match('/^[a-zA-Z][0-9a-zA-Z_]{2,23}[0-9a-zA-Z]$/', $username)) {
        $user_name_error = "Invalid User Name"; 
        $error = 1;
        }
    }
   
    if(isset($_POST['user_password'])){
        $password = $_POST['user_password'];
    }
    if(empty($password)) {
        $password_error = "Enter password";
        $error = 1;
    }

    if(!empty($username)){
        if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
            $_SESSION['userid'] = "admin"; // Unique identifier for admin.
            $_SESSION['username'] = ADMIN_USERNAME;
            $_SESSION['role'] = "admin";
        
            header("Location: dashboard.php");
            exit();
        }else {
            $user_error = "Invalid User.";
        }
    }
    // Check if admin is logging in
   
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
    <title>Login</title>
    <style>
        .bo{padding: 0; margin: 30px 0px 0px;}
        .img1 img{height: auto; border-radius: 25px 0px 25px 0px;}
        .for{font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size: 20px;margin-top: 100px;}
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
            <!-- <li class="nav-item">
            <a class="nav-link" href="booking.php">Book Now</a>
            </li> -->
            <!-- <li class="nav-item active">
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
    <form action="login.php" method="POST">
        <h1 class="segoe text-center my-4">LOGIN FORM</h1>
        <div class="container">
            <div class="row bo">            
                <div class="col-lg-6 for pl-5">  
                    Username: <input type="text" name="user_name"><br><br>
                    <span style="color:red" ><?php if(!empty($user_name_error)) { echo $user_name_error; } ?></span><br><br>
                    Password: <input type="password" name="user_password"><br><br>
                    <span style="color:red" ><?php if(!empty($password_error)) { echo $password_error; } ?></span><br>
                    <span style="color:red" ><?php if(!empty($user_error)) { echo $user_error; } ?></span>
                    <center><input type="submit" name="submit" value="Login" class="btn btn-danger"></center>
                </div>
                <div class="col-lg-6">
                    <div class="img1">
                    <img src="images/login3.jpg"  alt="login" class="img-fluid" title="login" height="100">
                    </div>
                </div>
            </div>
        </div>
           
        
    </form>
</body>
</html>