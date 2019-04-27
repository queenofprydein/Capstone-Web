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
 try{
     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     if(isset($_POST['save_changes'])){
         $date = DateTime::createFromFormat('m/d/Y', $_POST["birth_date"]);
         $date_errors = DateTime::getLastErrors();
         if (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST["phone_number"])){
             $message = '<label>Invalid phone number entered. Use format ###-###-####</label>';
         } elseif (!filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)){
             $message = '<label>Invalid E-Mail address entered.</label>';
         } elseif ($date_errors['warning_count'] + $date_errors['error_count'] > 0) {
             $message = '<label>Invalid date format. Please use mm/dd/yyyy format.</label>';
         } elseif (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST["Emergency_Contact_Phone"])){
             $message = '<label>Invalid phone number entered for emergency contact. Use format ###-###-####</label>';
         } else {
             $sql =  "UPDATE Volunteer ";
             $sql .= "SET ";
             $sql .= "Last_Name= :input_Last_Name, ";
             $sql .= "First_Name= :input_First_Name, ";
             $sql .= "Middle_Name= :input_Middle_Name, ";
             $sql .= "Phone= :input_Phone, ";
             $sql .= "Email= :input_Email, ";
             $sql .= "Preferred_Method_Of_Contact= :input_Preferred_Method_Of_Contact, ";
             $sql .= "BirthDate= :input_BirthDate, ";
             $sql .= "Gender= :input_Gender, ";
             $sql .= "Emergency_Contact_Phone= :input_Emergency_Contact_Phone, ";
             $sql .= "Emergency_Contact_Name= :input_Emergency_Contact_Name, ";
             $sql .= "Community_Service= :input_Community_Service ";
             $sql .= "WHERE Login_Name= '". $_SESSION["username"] ."'";

             $statement = $connect->prepare($sql);

             $statement->execute([
             'input_Last_Name' => $_POST["last_name"], 
             'input_First_Name' => $_POST["first_name"], 
             'input_Middle_Name' => $_POST["middle_name"], 
             'input_Phone' => $_POST["phone_number"], 
             'input_Email' => $_POST["user_email"], 
             'input_Preferred_Method_Of_Contact' => $_POST["contact_method"], 
             'input_BirthDate' => $_POST["birth_date"], 
             'input_Gender' => $_POST["gender"], 
             'input_Emergency_Contact_Phone' => $_POST["contact_phone"], 
             'input_Emergency_Contact_Name' => $_POST["contact_name"], 
             'input_Community_Service' => $_POST["community_service"]
             ]);

             header("location:landing_page.php");
         }
     }

 } catch (PDOException $error) {
     $message = $error->getMessage();
 }
 ?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>SM - Change Information</title>
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
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <br>
            <?php
            if (isset($message)) {
                echo '<label class="text-danger">' . $message . '</label>';
            }
            ?>   
            <form method="post">
                <?php
                $sql = 'SELECT * FROM Volunteer WHERE Volunteer_ID = '. $_SESSION["volunteerid"];
                $statement = $connect->query($sql);
                $result = $statement->fetch();

                echo "<h3>Make any required changes to the information below.<br></h3>";
                echo '<label>Last Name (required)</label>';
                echo '<input type="text" name="last_name" required class="form-control" value="' . $result["Last_Name"] . '"><br>';
                echo 'First Name (required)<input type="text" name="first_name" required class="form-control" value=' . $result["First_Name"] . '><br>';
                echo 'Middle Name<input type="text" name="middle_name" class="form-control" value=' . $result["Middle_Name"] . '><br>';
                echo 'Phone [###-###-####]<input type="text" name="phone_number" class="form-control" value=' . $result["Phone"] . '><br>';
                echo 'E-Mail (required)<input type="text" name="user_email" required class="form-control" value=' . $result["Email"] . '><br>';

                echo '<div class="form-group">';
                    echo '<label for="method_ID">Preferred Method of contact (required)</label>';
                    echo '<select class="form-control" id="method_ID" name="contact_method" required>';
                        $sql_method = "SELECT * FROM Preferred_Method_Of_Contact";
                        $statement_method = $connect->query($sql_method);
                        while ($row = $statement_method->fetch()) {
                            echo '<option ';
                            if ($row["Method_Name"] == $result["Preferred_Method_Of_Contact"]){
                                echo 'selected="selected" ';
                            }
                            echo 'value="'. $row["Method_Name"] .'">'. $row["Method_Description"] .'</option>';
                        } 
                    echo '</select>';
                echo '</div>';

                echo 'Birth Date [mm/dd/yyyy] (required)<input type="text" name="birth_date" required class="form-control" value=' . $result["BirthDate"] . '><br>';

                echo '<div class="form-group">';
                    echo '<label for="Gender_ID">Gender (required)</label>';
                    echo '<select class="form-control" id="Gender_ID" name="gender" required>';
                        $sql_gender = "SELECT * FROM Gender";
                        $statement_gender = $connect->query($sql_gender);
                        while ($row = $statement_gender->fetch()) {
                            echo '<option ';
                            if ($row["Gender"] == $result["Gender"]){
                                echo 'selected="selected" ';
                            }
                            echo 'value="'. $row["Gender"] .'">'. $row["Gender_Description"] .'</option>';
                        } 
                    echo '</select>';
                echo '</div>';

                echo 'Emergency Contact Phone Number [###-###-####]<input type="text" name="contact_phone" class="form-control" value=' . $result["Emergency_Contact_Phone"] . '><br>';
                echo 'Emergency Contact Name<input type="text" name="contact_name" class="form-control" value=' . $result["Emergency_Contact_Name"] . '><br>';

                echo '<div class="form-group">';
                    echo '<label for="community_ID">Is This For Community Service? (required)</label>';
                    echo '<select class="form-control" id="community_ID" name="community_service" required>';
                        echo '<option ';
                        if ($result["Preferred_Method_Of_Contact"] == 'Y'){
                            echo 'selected="selected" ';
                        }
                        echo 'value="Y">Y</option>';
                        echo '<option ';
                        if ($result["Preferred_Method_Of_Contact"] == 'N'){
                            echo 'selected="selected" ';
                        }
                        echo 'value="N">N</option>';
                    echo '</select>';
                echo '</div>';
                ?>
                <br>

                <div  align="right"> 
                    <input type="submit" name="save_changes" class="btn btn-success" value="Save Changes">
                </div>
            </form>
            <?php
            if (isset($message)) {
                echo '<label class="text-danger">' . $message . '</label>';
            }
            ?>   
            <form action="landing_page.php">
                <input type="submit" name="button_cancel" class="btn btn-info" value="Cancel">
            </form>
        </div>
    </body>
</html>