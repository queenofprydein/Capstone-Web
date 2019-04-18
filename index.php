<!DOCTYPE html>
<!--
Copyright (C) 2019
   Alondra Dorantes <dorantesa2016@forsythtech.edu>
   Dana Caldwell <caldwelld2608@forsythtech.edu>
   Dung Duong <duongd1067@forsythtech.edu>
   Marshall Casey <caseym1325@students.forsythtech.edu>
   William West <westw2305@forsythtech.edu>
Created for the FTCC course CSC-289-900-2019SP.
This program can be freely copied and/or distributed.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>SM</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!--<div class="container" style="width:500px;">-->
        <div class="mx-auto" style="width: 400px;" align="center">
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <a href="login/login.php">Login Test Page</a>
            <br>
            <a href="landing_page.php">Landing Page</a>
            <br>
            <form action="landing_page.php" method="post">
                <!-- 'name' is what is passed along. -->
                Username:<input type="text" name="user_name" class="form-control"><br>
                Password:<input type="text" name="their_password" class="form-control"><br>
                <input type="submit" name="the_button"  class="btn btn-info" value="Login">
            </form>
            <br>
            <form action="create_account.html">
                <input type="submit" name="create_button" class="btn btn-success" value="Create Account">
            </form>
            <br>
            <form action="reset_password.html">
                <input type="submit" name="forgot_button" class="btn btn-warning" value="Forgot Password">
            </form>
        </div>
    </body>
</html>