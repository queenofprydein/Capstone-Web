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
<?php
session_start();

if(isset($_SESSION["username"])){
    //echo '<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';
} else {
    header("location:index.php");
}
include "db_function.php";
$connect = connection();

if (null !== filter_input(INPUT_POST, 'button_add')) {//to run PHP script on submit
    $selected_vol = $_SESSION["volunteerid"];  // Storing Selected Value In Variable
    if (null !== filter_input(INPUT_POST, 'shift_list')) {
        foreach ($_POST['shift_list'] as $selected_shift) {
            $sql_insert = 'INSERT INTO Volunteer_Schedule (Shift_ID, Volunteer_ID) VALUES ('. $selected_shift. ',  '. $selected_vol .')';
            echo $sql_insert . "<br>";
            $stmt_insert = $connect->query($sql_insert);
            header("location:landing_page.php");
        }
    }
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SM - Select Shift</title>
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
        <div class="ex2" align="center">
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <br>
            <form action="#" method="post">
            <?php
            $sql = "SELECT SHIFT.Shift_ID, SHIFT_DESCRIPTION, START_DATETIME, END_DATETIME, MINIMUM_AGE, MALES_ONLY ";
            $sql .= "FROM SHIFT ";
            $sql .= "LEFT JOIN VOLUNTEER_SCHEDULE VOL ON VOL.SHIFT_ID = SHIFT.SHIFT_ID ";
            $sql .= "WHERE START_DATETIME > GETDATE() ";
            $sql .= "AND SHIFT.SHIFT_ID NOT IN ( ";
            $sql .=            "SELECT SHIFT_ID FROM VOLUNTEER_SCHEDULE ";
            $sql .=            "WHERE VOLUNTEER_ID = ". $_SESSION["volunteerid"];
            $sql .=            ") ";
            $sql .= "AND MALES_ONLY = ";
            $sql .=            "(CASE WHEN ";
            $sql .=            "(SELECT GENDER FROM VOLUNTEER WHERE VOLUNTEER_ID = ". $_SESSION["volunteerid"] .") <> 'MA' THEN 'N' ";
            $sql .=            "ELSE MALES_ONLY END) ";
            $sql .= "AND MINIMUM_AGE = ";
            $sql .=            "(CASE ";
            $sql .=            "WHEN (SELECT BIRTHDATE FROM VOLUNTEER WHERE VOLUNTEER_ID = ". $_SESSION["volunteerid"] .") > DATEADD(YEAR, -13, GETDATE()) THEN 0 ";
            $sql .=            "WHEN (SELECT BIRTHDATE FROM VOLUNTEER WHERE VOLUNTEER_ID = ". $_SESSION["volunteerid"] .") > DATEADD(YEAR, -18, GETDATE()) THEN 13 ";
            $sql .=            "ELSE MINIMUM_AGE END) ";
            $sql .= "GROUP BY SHIFT.SHIFT_ID, SHIFT_DESCRIPTION, START_DATETIME, END_DATETIME, VOLUNTEER_MAXIMUM, MINIMUM_AGE, MALES_ONLY ";
            $sql .= "HAVING COUNT(VOLUNTEER_ID) < VOLUNTEER_MAXIMUM ";
            
            $statement = $connect->query($sql);
                while ($row = $statement->fetch()) {
                    echo '<div class="custom-control custom-checkbox"> ';
                    echo '<input type="checkbox" class="custom-control-input" name="shift_list[]" value="' . $row["Shift_ID"] . '" id="addCheck'. $row["Shift_ID"] .'">';
                    echo '<label class="custom-control-label" for="addCheck'. $row["Shift_ID"] .'">';
                    
                    echo $row["SHIFT_DESCRIPTION"] .' at ';
                    echo $row["START_DATETIME"] .' until ';

                    echo '</label>';
                    echo '</div>';                    
                 }
                if($statement->rowCount() > 0) {
//                    echo '<input type="submit" class="btn btn-warning" name="button_delete" value="Delete Selected Shifts">';
                    echo '<input type="submit" class="btn btn-info" name="button_add" value="Add Shifts">';                    
                } else {
                    echo '<h4>No Available Shifts.</h4>';
                }
                ?>
                <br>
            </form>
            <form action = "landing_page.php">
                <input type = "submit" class="btn btn-warning" name = "button_cancel" value = "Cancel">
            </form>
        </div>
    </body>
</html>