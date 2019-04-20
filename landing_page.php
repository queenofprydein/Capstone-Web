<?php

/* 
 * Copyright (C) 2019 Marshall Casey <caseym1325@students.forsythtech.edu>
 * Created for the FTCC course CSC-289-900-2019SP.
 * This program can be freely copied and/or distributed.
 */

session_start();

echo '<h2>Name before: '. $_SESSION["username"].'</h2>';
echo '<h2>Data before: '. $_SESSION["userdata"].'</h2>';
    
if(isset($_SESSION["username"])){
    echo '<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';
} else {
    header("location:index.php");
}

if($_SESSION["userdata"]=="TRUE"){
    echo '<h3>Data flag is set to: ' . $_SESSION["userdata"] .'</h3>';
} else {
    echo '<h1>CHANGE TO gather_information.php LEG OF VALIDATION.</h1>';
    header("location:gather_information.php");
}

?>

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <style>
            div.ex1 {
              width:500px;
              margin: auto;
              border: 3px solid #73AD21;
            }

            div.ex2 {
              max-width:500px;
              margin: auto;
            }
        </style>
    </head>
    <body>
        <div class="ex2">
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






            <?php
            include 'db_function.php';
            $db = connection();

            //SQL Query
            $sql = 'SELECT * FROM Volunteer_Schedule';
            $results = $db->query($sql);
            //End Query

            foreach($results as $row){
                echo $row['Shift_ID'].', '.$row['Volunteer_ID'].'<br>';
            }
            ?>

            <form action="change.php" class="btn btn-info">
                <input type="submit" name="button_logout" value="Change User">
            </form>



            <br>

            <form action="change_information.php">
                <input type="submit" name="button_change_info" value="Change Personal Information">
            </form>
            <br>
            <form action="add_shift.php">
                <input type="submit" name="button_add_shifts" value="Add Shifts">
            </form>
            <br>
            <form action="logout.php">
                <input type="submit" name="button_logout" value="Logout">
            </form>
            <br>
        </div>
    </body>
</html>