<?php

/* 
 * Copyright (C) 2019 Marshall Casey <caseym1325@students.forsythtech.edu>
 * Created for the FTCC course CSC-289-900-2019SP.
 * This program can be freely copied and/or distributed.
 */
session_start();

echo '<br>';
if (isset($_SESSION["username"])){
    echo '<h2>Name before: '. $_SESSION["username"].'</h2>';    
} else {
    echo '<h2>username is not set</h2>';
}
echo '<br>';
if (isset($_SESSION["userdata"])){
    echo '<h2>Data before: '. $_SESSION["userdata"].'</h2>';    
} else {
    echo '<h2>userdata is not set</h2>';
}
echo '<br>';



?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SM</title>
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
            <br>Last_Name
            <br>First_Name
            <br>Middle_Name *
            <br>Phone *
            <br>Email
            <br>Preferred_Method_Of_Contact
            <br>BirthDate
            <br>Gender
            <br>Emergency_Contact_Phone *
            <br>Emergency_Contact_Name *
            <br>Community_Service

            <br>Login_Name
            <br>Password_Hash
            <br>
            <input type="submit" value="" />

<?php
$newUser_Last_Name = "Fred";
$newUser_First_Name = "Fred";
$newUser_Middle_Name = "";
$newUser_Phone = "";
$newUser_Email = "yes";
$newUser_Preferred_Method_Of_Contact = "E";
$newUser_BirthDate = "1/19/02";
$newUser_Gender = "MA";
$newUser_Emergency_Contact_Phone = "";
$newUser_Emergency_Contact_Name = "";
$newUser_Community_Service = "N";

$sql =  "INSERT INTO Volunteer (";
$sql .= "Last_Name, ";
$sql .= "First_Name, ";
$sql .= "Middle_Name, ";
$sql .= "Phone, ";
$sql .= "Email, ";
$sql .= "Preferred_Method_Of_Contact, ";
$sql .= "BirthDate, ";
$sql .= "Gender, ";
$sql .= "Emergency_Contact_Phone, ";
$sql .= "Emergency_Contact_Name, ";
$sql .= "Community_Service";
$sql .= ") VALUES (";
$sql .= "'". $newUser_Last_Name ."', ";
$sql .= "'". $newUser_First_Name ."', ";
$sql .= "'". $newUser_Middle_Name ."', ";
$sql .= "'". $newUser_Phone ."', ";
$sql .= "'". $newUser_Email ."', ";
$sql .= "'". $newUser_Preferred_Method_Of_Contact ."', ";
$sql .= "'". $newUser_BirthDate ."', ";
$sql .= "'". $newUser_Gender ."', ";
$sql .= "'". $newUser_Emergency_Contact_Phone ."', ";
$sql .= "'". $newUser_Emergency_Contact_Name ."', ";
$sql .= "'". $newUser_Community_Service ."'";
$sql .= ")";

echo $sql;


$db = connection();

//SQL Query
//$results = $db->query($sql);
//End Query

//echo "<pre>";
//var_dump($results);
//echo "</pre>";
        
//        foreach($results as $row){
//            echo $row['Last_Name'].', '.$row['First_Name'].'<br>';
//        }

//Login_Name = "";
//Volunteer_ID = "SELECT statement FROM Volunteer";
//Password_Hash = "";
?>








            <form action="gather_information.php">
                <input type="submit" name="create_button" class="btn btn-success" value="Create Account">
            </form>
            <br>
            <form action="landing_page.html">
                <input type="submit" name="button_cancel" class="btn btn-warning" value="Cancel">
            </form>
            
            <?php 
 
            // See the password_hash() example to see where this came from.
            $hash = '$2y$10$vaX6d7eRcic4NwecxOYCbepde17a672rjpeYxNHb8PzSygU/9NfBW';

            if (password_verify('Password', $hash)) {
                echo 'Password is valid!';
            } else {
                echo 'Invalid password.';
            }

            ?> 

        </div>
    </body>
</html>