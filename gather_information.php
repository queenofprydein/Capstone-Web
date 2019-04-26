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
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['add_data'])){
        $date = DateTime::createFromFormat('m/d/Y', $_POST["BirthDate"]);
        $date_errors = DateTime::getLastErrors();
        if (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST["Phone"])){
            $message = '<label>No Phone</label>';
        } elseif (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)){
            $message = '<label>Bad Email</label>';
        } elseif ($date_errors['warning_count'] + $date_errors['error_count'] > 0) {
            $message = '<label>Bad BirthDate</label>';
        } elseif (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST["Emergency_Contact_Phone"])){
            $message = '<label>Bad Emergency_Contact_Phone</label>';
        } else {
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
            $sql .= "Community_Service, ";
            $sql .= "Login_Name";
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
            $sql .= ":input_Community_Service, ";
            $sql .= ":input_Login_Name ";        
            $sql .= ")";

            //"SELECT Login_Name FROM Volunteer_Login WHERE Login_Name = :username";

//            $statement = $connect->prepare($sql);

//            $statement->execute([
//            'input_Last_Name' => $_POST["Last_Name"], 
//            'input_First_Name' => $_POST["First_Name"], 
//            'input_Middle_Name' => $_POST["Middle_Name"], 
//            'input_Phone' => $_POST["Phone"], 
//            'input_Email' => $_POST["Email"], 
//            'input_Preferred_Method_Of_Contact' => $_POST["Preferred_Method_Of_Contact"], 
//            'input_BirthDate' => $_POST["BirthDate"], 
//            'input_Gender' => $_POST["Gender"], 
//            'input_Emergency_Contact_Phone' => $_POST["Emergency_Contact_Phone"], 
//            'input_Emergency_Contact_Name' => $_POST["Emergency_Contact_Name"], 
//            'input_Community_Service' => $_POST["Community_Service"], 
//            'input_Login_Name' => $_SESSION["username"] 
//            ]);

            // IS THIS FETCH LINE REALLY NEEDED?
//            $result = $statement->fetch();

            $message = '<label>'. $sql .'</label>';
        }
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
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <br>
            <form method="post">
                <label>Last Name (required)</label>
                <input type="text" name="Last_Name" required class="form-control" />
                <br>
                <label>First Name (required)</label>
                <input type="text" name="First_Name" required class="form-control" />
                <br>
                <label>Middle Name</label>
                <input type="text" name="Middle_Name" class="form-control" />
                <br>
                <label>Phone</label>
                <input type="text" name="Phone" class="form-control" />
                <br>
                <label>E-Mail (required)</label>
                <input type="text" name="Email" required class="form-control" />
                <br>
                
    <div class="form-group">
        <label for="Method_Of_Contact_ID">Preferred Method Of Contact (required)</label>
        <select class="form-control" id="Method_Of_Contact_ID" name="Preferred_Method_Of_Contact" required>
            <option value="">None</option>
            <?php
                // Make a loop for these things
            ?>
            <option value="E">E</option>
            <option value="P">P</option>
            <option value="T">T</option>
        </select>
    </div>

             <input type="text" name="Preferred_Method_Of_Contact" class="form-control" />
                <br>
                <label>Birth Date (required)</label>
                <input type="text" name="BirthDate" required class="form-control" />
                <br>
  
    <div class="form-group">
        <label for="Gender_ID">Gender (required)</label>
        <select class="form-control" id="Gender_ID" name="Gender" required>
            <option value="">None</option>
            <?php
            $sql = "SELECT * FROM Gender";
            $statement = $connect->query($sql);
            $result = $statement->fetch();
                
//            echo "<pre>";
//            var_dump($result);
//            echo "</pre>";

            while ($row = $statement->fetch()) {
                echo '<option value="'. $row["Gender_Description"] .'">'. $row["Gender"] .'</option>';
            } 
            ?>
            <!--
            <option value="CD">CD</option>
            <option value="CR">CR</option>
            <option value="FE">FE</option>
            <option value="GN">GN</option>
            <option value="MA">MA</option>
            <option value="TF">TF</option>
            <option value="TM">TM</option>
            -->
        </select>
    </div>

                <br>
                <label>Emergency Contact Name</label>
                <input type="text" name="Emergency_Contact_Name" class="form-control" />
                <br>
                <label>Emergency Contact Phone Number</label>
                <input type="text" name="Emergency_Contact_Phone" class="form-control" />
                <br>
                
                
    <div class="form-group">
        <label for="Community_Service_ID">Is This For Community Service (required)</label>
        <select class="form-control" id="Community_Service_ID" name="Community_Service" required>
            <option value="">None</option>
            <?php
                // Make a loop for these things
            ?>
            <option value="E">Y</option>
            <option value="P">N</option>
        </select>
    </div>
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