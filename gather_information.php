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
include 'db_function.php';
$connect = connection();

if(isset($_SESSION["username"])){
    //echo '<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';
} else {
    header("location:index.php");
}

try{
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['add_data'])){
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
        $sql .= ":input_Last_Name, ";
        $sql .= ":input_First_Name, ";
        $sql .= ":input_Middle_Name, ";
        $sql .= ":input_Phone, ";
        $sql .= ":input_Email, ";
        $sql .= ":input_Preferred_Method_Of_Contact, ";
        $sql .= ":input_BirthDate, ";
        $sql .= ":input_Gender, ";
        $sql .= ":input_Emergency_Contact_Phone, ";
        $sql .= ":input_Emergency_Contact_Name, ";
        $sql .= ":input_Community_Service ";
        $sql .= ")";
        
        "SELECT Login_Name FROM Volunteer_Login WHERE Login_Name = :username";
        
        $statement = $connect->prepare($query);
        //$statement->execute(['username' => $_POST["username"], 'password' => $_POST["password"]]);


        $statement->execute(['username' => $_POST["username"]]);
        $result = $statement->fetch();
        
$statement->execute([
'input_Last_Name' => $_POST["Last_Name"], 
'input_First_Name' => $_POST["First_Name"], 
'input_Middle_Name' => $_POST["Middle_Name"], 
'input_Phone' => $_POST["Phone"], 
'input_Email' => $_POST["Email"], 
'input_Preferred_Method_Of_Contact' => $_POST["Preferred_Method_Of_Contact"], 
'input_BirthDate' => $_POST["BirthDate"], 
'input_Gender' => $_POST["Gender"], 
'input_Emergency_Contact_Phone' => $_POST["Emergency_Contact_Phone"], 
'input_Emergency_Contact_Name' => $_POST["Emergency_Contact_Name"], 
'input_Community_Service' => $_POST["Community_Service"], 
]);
        
        
        //SQL Query
        //$results = $connect->query($sql);
        //End Query

        $message = '<label>'. $sql .'</label>';

    }
    
} catch (PDOException $error) {
    $message = $error->getMessage();
}




//$db = connection();

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
            
            <?php
            // This is for debugging only. Remove it for live.
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

            <form method="post">
                <label>Last_Name</label>
                <input type="text" name="Last_Name" class="form-control" />
                <br>
                <label>First_Name</label>
                <input type="text" name="First_Name" class="form-control" />
                <br>
                <label># Middle_Name</label>
                <input type="text" name="Middle_Name" class="form-control" />
                <br>
                <label># Phone</label>
                <input type="text" name="Phone" class="form-control" />
                <br>
                <label>Email</label>
                <input type="text" name="Email" class="form-control" />
                <br>
                <label>Preferred_Method_Of_Contact</label>
                <input type="text" name="Preferred_Method_Of_Contact" class="form-control" />
                <br>
                <label>BirthDate</label>
                <input type="text" name="BirthDate" class="form-control" />
                <br>
                <label>Gender</label>
                <input type="text" name="Gender" class="form-control" />
                <br>
                <label># Emergency_Contact_Phone</label>
                <input type="text" name="Emergency_Contact_Phone" class="form-control" />
                <br>
                <label># Emergency_Contact_Name</label>
                <input type="text" name="Emergency_Contact_Name" class="form-control" />
                <br>
                <label>Community_Service</label>
                <input type="text" name="Community_Service" class="form-control" />
                <br>
                
                <div  align="right"> 
                    <input type="submit" name="add_data" class="btn btn-success" value="Add Data">
                </div>
            </form>

            <br>
            <form action="logout.php">
                <input type="submit" class="btn btn-info" name="button_logout" value="Logout">
            </form>
            
            <?php
            if (isset($message)) {
                echo '<label class="text-danger" align="right">' . $message . '</label>';
            }
            ?> 

        </div>
    </body>
</html>