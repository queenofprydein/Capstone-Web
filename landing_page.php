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

include 'db_function.php';
$connect = connection();

try{
    $sql_volunteer_id =  "SELECT Volunteer_ID FROM Volunteer WHERE Login_Name = '". $_SESSION["username"] ."'";
    $statement_volunteer_id = $connect->query($sql_volunteer_id);
    $result = $statement_volunteer_id->fetch();
    if(is_array($result)) {
        $_SESSION["volunteerid"] = $result["Volunteer_ID"];
    } else {
        header("location:gather_information.php");
    }   
} catch (PDOException $error) {
    $message = $error->getMessage();
}

try{
    if (null !== filter_input(INPUT_POST, 'button_delete')) {
        $selected_vol = $_SESSION["volunteerid"];
        if (null !== filter_input(INPUT_POST, 'shift_list')) {
            foreach ($_POST['shift_list'] as $selected_shift) {
                $sql_delete = "DELETE FROM Volunteer_Schedule WHERE Shift_ID = ". $selected_shift ." AND Volunteer_ID =". $_SESSION["volunteerid"];
                echo $sql_delete . "<br>";
                $stmt_insert = $connect->query($sql_delete);
                header("location:landing_page.php");
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}            
?>
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
        <div class="ex2" align="center">            
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <br>
            <form action="#" method="post">
                <h1>Current Scheduled Shifts</h1>
                <?php
                //$sql = 'SELECT * FROM Volunteer_Schedule WHERE Volunteer_ID ='. $_SESSION["volunteerid"];
                
                $sql =  'SELECT Shift.Shift_ID, Shift_Description, Start_DateTime, End_DateTime ';
                $sql .= 'FROM Shift ';
                $sql .= 'LEFT JOIN Volunteer_Schedule ON Volunteer_Schedule.Shift_ID = Shift.Shift_ID ';
                $sql .= 'WHERE ';
                $sql .= 'START_DATETIME > GETDATE() AND Volunteer_ID = '. $_SESSION["volunteerid"];
                
                
                $stmt = $connect->query($sql);
                while ($row = $stmt->fetch()) {
                    // THIS STUFF NEEDS TO BE ENTERED BELOW
    //                    <div class="custom-control custom-checkbox">  
    //                        <input type="checkbox" class="custom-control-input" id="customCheck3">
    //                        <label class="custom-control-label" for="customCheck3">Check this custom checkbox</label>
    //                    </div>
                    // ALL THE WAY TO HERE
                    echo '<div class="custom-control custom-checkbox"> ';
//                    echo '<input type="checkbox" class="custom-control-input" name="shift_list[]" value="' . $row["Shift_ID"] . '"> ';
                    echo '<input type="checkbox" class="custom-control-input" name="shift_list[]" value="' . $row["Shift_ID"] . '" id="deleteCheck'. $row["Shift_ID"] .'">';
                    echo '<label class="custom-control-label" for="deleteCheck'. $row["Shift_ID"] .'">';
                    echo 'Name: ';
                    echo $row["Shift_Description"] . '  Time: ';
                    echo $row["Start_DateTime"];
                    echo '</label>';
                    echo '</div>';
                    
//                    OLD STUFF
//                    echo '<input type="checkbox" class="custom-control-input" name="shift_list[]" value="' . $row["Shift_ID"] . '"> ';
//                    echo 'Shift: ';
//                    echo $row["Shift_ID"] . '  Volunteer: ';
//                    echo $row["Volunteer_ID"];
//                    echo '<br>';
                    
                }
                if($stmt->rowCount() > 0) {
                    echo '<input type="submit" class="btn btn-warning" name="button_delete" value="Delete Selected Shifts">';
                } else {
                    echo '<h4>No scheduled Shifts.</h4>Click the [Add Shifts] button to volunteer for a shift.';
                }
                ?>
            </form>
            <?php
            if (isset($message)) {
                echo '<label class="text-danger">' . $message . '</label>';
            }
            ?>
            
            
            
             <?php

//            if (null !== filter_input(INPUT_POST, 'button_delete')) {
//                $selected_vol = $_SESSION["volunteerid"];
//                if (null !== filter_input(INPUT_POST, 'shift_list')) {
//                    foreach ($_POST['shift_list'] as $selected_shift) {
//                      //$sql_insert = 'INSERT INTO Volunteer_Schedule (Shift_ID, Volunteer_ID) VALUES ('. $selected_shift. ',  '. $selected_vol .')';
//                        $sql_delete = "DELETE FROM Volunteer_Schedule WHERE Shift_ID = ". $selected_shift ." AND Volunteer_ID =". $_SESSION["volunteerid"];
//                                   // "DELETE FROM Volunteer_Schedule WHERE Shift_ID = ". $selected_shift ." AND Volunteer_ID =". $_SESSION["volunteerid"];
//
//
//                        echo $sql_delete . "<br>";
//                        $stmt_insert = $connect->query($sql_delete);
//                        //header("Refresh:0");
//                        header("location:landing_page.php");
//                    }
//                }
//            }
            ?>

            <br>
            <form action="add_shift.php">
                <input type="submit" class="btn btn-success" name="button_add_shifts" value="Add Shifts">
            </form>
            <br>
            <form action="change_information.php">
                <input type="submit" class="btn btn-info" name="button_change_info" value="Change Personal Information">
            </form>
            <br>
            <form action="logout.php">
                <input type="submit" class="btn btn-danger" name="button_logout" value="Logout">
            </form>
            <br>
            <?php
            if (isset($message)) {
                echo '<label class="text-danger">' . $message . '</label>';
            }
            ?>
        </div>
    </body>
</html>