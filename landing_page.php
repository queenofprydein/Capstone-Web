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
        <title>SM - Landing Page</title>
    </head>
    <body>
    <center>
        <?php
        include "db_connect.php";

        $id = 3;
        $sql_volunteer = 'SELECT * FROM Volunteer';
        $stmt_volunteer = $connection->query($sql_volunteer);

        //echo '<form action="#" method="post">';
        echo '<select name="selected_volunteer">';
        while ($row = $stmt_volunteer->fetch()) {
            //Volunteer_ID
            //Last_Name
            //First_Name
            //Middle_Name
            //Phone
            //Email
            //Preferred_Method_Of_Contact
            //BirthDate
            //Gender
            //Emergency_Contact_Phone
            //Emergency_Contact_Name
            //Community_Service
            echo '<option value="' . $row->Volunteer_ID . '">' . $row->First_Name . '</option>';
        }
        echo '</select>';
        //echo '</form>';
        echo '<br>';
        ?>  





        <br>

        <form action="change_information.php">
            <input type="submit" name="button_change_info" value="Change Personal Information">
        </form>
        <br>
        <form action="add_shift.php">
            <input type="submit" name="button_add_shifts" value="Add Shifts">
        </form>
        <br>
        <form action="logout.html">
            <input type="submit" name="button_logout" value="Logout">
        </form>
        <br>
    </center>
    </body>
</html>