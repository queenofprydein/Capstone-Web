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
        <title>SM - Select Shift</title>

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
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <br>



            <?php
            session_start();
    
            if(isset($_SESSION["username"])){
                //echo '<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';
            } else {
                header("location:index.php");
            }
            include "db_connect.php";
            ?>
            <form action="#" method="post">
            <?php
            //$id = 3;
            //$sql_volunteer = 'SELECT * FROM Volunteer';
            //$stmt_volunteer = $connection->query($sql_volunteer);

            
//            echo '<select name="selected_volunteer">';
//            while ($row = $stmt_volunteer->fetch()) {
//                //Volunteer_ID
//                //Last_Name
//                //First_Name
//                //Middle_Name
//                //Phone
//                //Email
//                //Preferred_Method_Of_Contact
//                //BirthDate
//                //Gender
//                //Emergency_Contact_Phone
//                //Emergency_Contact_Name
//                //Community_Service
//                echo '<option value="' . $row->Volunteer_ID . '">' . $row->First_Name . '</option>';
//            }
//            echo '</select>';
//            echo '<br>';

                $sql = 'SELECT * FROM Shift';
                $stmt = $connection->query($sql);
                while ($row = $stmt->fetch()) {
                    //Shift_ID
                    //Shift_Number
                    //Start_DateTime
                    //End_DateTime
                    //Volunteer_Assigned
                    //Volunteer_Needed
                    //Males_Only
                    //Minimum_Age
                    echo '<input type="checkbox" class="custom-control-input" name="shift_list[]" value="' . $row->Shift_ID . '"> ';
                    //echo $row->Shift_Number . '#';
                    echo $row->Start_DateTime . ' until ';
                    echo $row->End_DateTime;
                    //echo $row->Volunteer_Assigned . '#';
                    //echo $row->Volunteer_Needed . '#';
                    //echo $row->Males_Only . '#';
                    //echo $row->Minimum_Age;
                    echo '<br>';
                }
                ?>
                <br>

                <input type = "submit" name = "button_add" value = "Add Shifts">
            </form>

            <?php
            if (null !== filter_input(INPUT_POST, 'button_add')) {//to run PHP script on submit
                $selected_vol = $_SESSION["volunteerid"];  // Storing Selected Value In Variable
                if (null !== filter_input(INPUT_POST, 'shift_list')) {
                    foreach ($_POST['shift_list'] as $selected_shift) {
                        $sql_insert = 'INSERT INTO Volunteer_Schedule (Shift_ID, Volunteer_ID) VALUES ('. $selected_shift. ',  '. $selected_vol .')';
                        echo $sql_insert . "<br>";
                        $stmt_insert = $connection->query($sql_insert);
                        header("location:landing_page.php");
                    }
                }
            }
            ?>

            <form action = "landing_page.php">
                <input type = "submit" name = "button_cancel" value = "Cancel">
            </form>
        </div>
    </body>
</html>