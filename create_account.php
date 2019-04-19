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
        <div class="mx-auto" align="center">
            <a href="index.html">Make Account</a>

            <form action="set_it_up.html">
                <input type="submit" name="create_button" class="btn btn-success" value="Create Account">
            </form>
            <br>
            <form action="landing_page.html">
                <input type="submit" name="button_cancel" class="btn btn-warning" value="Cancel">
            </form>
            <?php 
  
            // PHP code to illustrate the working  
            // of md5(), sha1() and hash() 

            $str = 'Password'; 
            $salt = 'Username20Jun96'; 
            echo sprintf("The md5 hashed password of %s is: %s\n", $str, md5($str.$salt)); 
            echo sprintf("The sha1 hashed password of %s is: %s\n", $str, sha1($str.$salt)); 
            echo sprintf("The gost hashed password of %s is: %s\n", $str, hash('gost', $str.$salt)); 

            ?> 
        </div>
    </body>
</html>