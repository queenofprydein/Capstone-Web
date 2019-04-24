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
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
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
        <?php
session_start();
    
if(isset($_SESSION["username"])){
    //echo '<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';
} else {
    header("location:index.php");
}

//echo "Username is: ". $_SESSION["username"];
include 'db_function.php';
$connect = connection();

try{
    //$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql_volunteer_id =  "SELECT Volunteer_ID FROM Volunteer WHERE Login_Name = '". $_SESSION["username"] ."'";
                
        $statement_volunteer_id = $connect->query($sql_volunteer_id);
        //$statement->execute(['username' => $_POST["username"], 'password' => $_POST["password"]]);


       // $volunteer_id = $stmt_volunteer_id->Volunteer_ID;
        
//        echo "<br><pre>";
//        print_r($statement_volunteer_id);
//        echo "</pre></br>";    
        
        $result = $statement_volunteer_id->fetch();
        
//        echo "<br><pre>";
//        print_r($result);
//        echo "</pre></br>";
        
        if(is_array($result)) {
            $_SESSION["volunteerid"] = $result["Volunteer_ID"];
        } else {
            header("location:gather_information.php");
        }   
        


        
        


    //if($_SESSION["userdata"]=="TRUE"){
        //echo '<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';
        //echo '<h3>Data flag is set to: ' . $_SESSION["userdata"] .'</h3>';






    // Set userdata to TRUE if user has data
//    $sql_volunteer = "SELECT Volunteer_ID FROM Volunteer_Login WHERE Login_Name = :username";
//    $statement2 = $connect->prepare($sql_volunteer);
//    $statement2->execute(['username' => $_POST["username"]]);
//    $result2 = $statement2->fetch();
//
//    if ($result2["Volunteer_ID"] == "") {
//        $_SESSION["userdata"] = "FALSE";
//    } else {
//        $_SESSION["userdata"] = "TRUE";
//    }
    //$_SESSION["userdata"] = TRUE;

} catch (PDOException $error) {
    $message = $error->getMessage();
}

?>
        
        
            


            <div class="ex2" align="center">            
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <br>
            <form action="#" method="post">
            <?php
                $sql = 'SELECT * FROM Volunteer_Schedule WHERE Volunteer_ID ='. $_SESSION["volunteerid"];
                $stmt = $connect->query($sql);
                while ($row = $stmt->fetch()) {
                    // THIS STUFF NEEDS TO BE ENTERED BELOW
//                    <div class="custom-control custom-checkbox">  
//                        <input type="checkbox" class="custom-control-input" id="customCheck3">
//                        <label class="custom-control-label" for="customCheck3">Check this custom checkbox</label>
//                    </div>
                    // ALL THE WAY TO HERE
                    echo '<input type="checkbox" class="custom-control-input" name="shift_list[]" value="' . $row["Shift_ID"] . '"> ';
                    echo 'Shift: ';
                    echo $row["Shift_ID"] . '  Volunteer: ';
                    echo $row["Volunteer_ID"];
                    echo '<br>';
                }
                ?>
                <br>

                <input type = "submit" name = "button_delete" value = "Delete Selected Shifts">
            </form>
            <br>
            <br>
            
             <?php

            if (null !== filter_input(INPUT_POST, 'button_delete')) {
                $selected_vol = $_SESSION["volunteerid"];
                if (null !== filter_input(INPUT_POST, 'shift_list')) {
                    foreach ($_POST['shift_list'] as $selected_shift) {
                      //$sql_insert = 'INSERT INTO Volunteer_Schedule (Shift_ID, Volunteer_ID) VALUES ('. $selected_shift. ',  '. $selected_vol .')';
                        $sql_delete = "DELETE FROM Volunteer_Schedule WHERE Shift_ID = ". $selected_shift ." AND Volunteer_ID =". $_SESSION["volunteerid"];
                                   // "DELETE FROM Volunteer_Schedule WHERE Shift_ID = ". $selected_shift ." AND Volunteer_ID =". $_SESSION["volunteerid"];
                        
                        
                        echo $sql_delete . "<br>";
                        $stmt_insert = $connect->query($sql_delete);
                        //header("Refresh:0");
                        header("location:landing_page.php");
                    }
                }
            }
            ?>

            <br>

            <form action="change_information.php">
                <input type="submit" class="btn btn-info" name="button_change_info" value="Change Personal Information">
            </form>
            <br>
            <form action="add_shift.php">
                <input type="submit" class="btn btn-info" name="button_add_shifts" value="Add Shifts">
            </form>
            <br>
            <form action="logout.php">
                <input type="submit" class="btn btn-info" name="button_logout" value="Logout">
            </form>
            <br>
            <?php
            if (isset($message)) {
                echo '<label class="text-danger">' . $message . '</label>';
            }
            ?>
            
            <div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input" id="customCheck1">
  <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
</div>  
<div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input" id="customCheck2">
  <label class="custom-control-label" for="customCheck2">Check this custom checkbox</label>
</div>  
<div class="custom-control custom-checkbox">  
    <input type="checkbox" class="custom-control-input" id="customCheck3">
    <label class="custom-control-label" for="customCheck3">Check this custom checkbox</label>
</div>
            
            
        </div>
    </body>
</html>