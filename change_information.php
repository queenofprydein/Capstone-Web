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


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>SM - Change Information</title>
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
        ?>

        <div class="ex2">   
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <br>
        
        <form method="post">
            <?php
            include "db_function.php";
            $connect = connection();

            $sql = 'SELECT * FROM Volunteer WHERE Volunteer_ID = '. $_SESSION["volunteerid"];
            $statement = $connect->query($sql);
            $result = $statement->fetch();

            echo "<h2>Change Whatever is Wrong.<br></h2>";
            echo 'Volunteer ID: ' . $result["Volunteer_ID"] . '<br>';
            echo '<label>Last Name</label>';
            echo '<input type="text" name="last_name" required value="' . $result["Last_Name"] . '"><br>';
            echo 'First Name:<input type="text" name="first_name" required value=' . $result["First_Name"] . '><br>';
            echo 'Middle Name:<input type="text" name="middle_name" value=' . $result["Middle_Name"] . '><br>';
            echo 'Phone:<input type="text" name="phone_number" value=' . $result["Phone"] . '><br>';
            echo 'E-Mail:<input type="text" name="user_email" required value=' . $result["Email"] . '><br>';
            echo 'Preferred Method of contact:<input type="text" name="contact_method" value=' . $result["Preferred_Method_Of_Contact"] . '><br>';
            echo 'Birth date:<input type="text" name="birth_date" required value=' . $result["BirthDate"] . '><br>';
            echo 'Gender:<input type="text" name="gender" required value=' . $result["Gender"] . '><br>';
            echo 'Emergency contact phone number:<input type="text" name="contact_phone" value=' . $result["Emergency_Contact_Phone"] . '><br>';
            echo 'Emergency contact name:<input type="text" name="contact_name" value=' . $result["Emergency_Contact_Name"] . '><br>';
            echo 'Community service (y/n):<input type="text" name="community_service" required value=' . $result["Community_Service"] . '><br>';
            ?>
            <br>

            <div  align="right"> 
                <input type="submit" name="save_changes" class="btn btn-success" value="Save Changes">
            </div>
        </form>
            
        <form action="landing_page.php">
            <input type="submit" name="button_cancel" value="Cancel">
        </form>
    </div>
        <?php
        
        // THIS SHOULD BE THE LOGIC FOR THE SAVE CHANGES BUTTON
        try{
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['save_changes'])){
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
        
        "SELECT Login_Name FROM Volunteer_Login WHERE Login_Name = :username";
        
        $statement = $connect->prepare($sql);
        //$statement->execute(['username' => $_POST["username"], 'password' => $_POST["password"]]);


        //$statement->execute(['username' => $_POST["username"]]);
        
        
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
'input_Community_Service' => $_POST["community_service"], 
'input_Login_Name' => $_SESSION["username"] 
]);

// IS THIS FETCH LINE REALLY NEEDED?
        //$result = $statement->fetch();
        //$result = $statement->fetch();
        //SQL Query
        //$results = $connect->query($sql);
        //End Query

        $message = '<label>'. $sql .'</label>';

    }
    
} catch (PDOException $error) {
    $message = $error->getMessage();
}


        ?>
        
    <?php
    if (isset($message)) {
        echo '<label class="text-danger">' . $message . '</label>';
    }
    ?>
</body>
</html>