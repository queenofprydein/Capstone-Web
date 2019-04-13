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
    </head>
    <body>
        <?php
            include "db_connect.php";
        ?>
      <center>
        ]SCHEDULE GOES HERE[<BR>
        <form action="change_information.php">
          <input type="submit" name="button_change_info" value="Change Personal Information">
        </form>
        <br>
        <form action="change_schedule.html">
          <input type="submit" name="button_change_sched" value="Change Availability">
        </form>
        <br>
        <form action="logout.html">
          <input type="submit" name="button_logout" value="Logout">
        </form>
      </center>
    </body>
</html>