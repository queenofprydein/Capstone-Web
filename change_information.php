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
        <title>SM - Change Information</title>
    </head>
    <body>
        <?php
        include "db_connect.php";
        ?>
        <?php
        $id = 3;
        $sql = 'SELECT * FROM Volunteer WHERE Volunteer_ID = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute(['id' => $id]);

        //$sql = 'SELECT * FROM Volunteer ';
        //$stmt = $connection->prepare($sql);
        //$stmt->execute([]);
        //$volunteers = $stmt->fetchAll();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //echo "<pre>";
        //echo "var_dump<br>";
        //var_dump($result);
        //echo "print_r<br>";
        //print_r($result);
        //echo "<pre>";
        //$result = $stmt->fetchColumn(2);
        //print("\nColumn 2 = $result\n");

        echo "<center>";
        echo "<h1>BANNER<br></h1>";
        echo "<h2>Change Whatever is Wrong.<br></h2>";
        echo 'Volunteer ID: ' . $result["Volunteer_ID"] . '<br>';
        echo 'Last Name: <input type="text" name="last_name" value="' . $result["Last_Name"] . '"><br>';
        echo 'First Name:<input type="text" name="first_name" value=' . $result["First_Name"] . '><br>';
        echo 'Middle Name:<input type="text" name="middle_name" value=' . $result["Middle_Name"] . '><br>';
        echo 'Phone:<input type="text" name="phone_number" value=' . $result["Phone"] . '><br>';
        echo 'E-Mail:<input type="text" name="user_email" value=' . $result["Email"] . '><br>';
        echo 'Preferred Method of contact:<input type="text" name="contact_method" value=' . $result["Preferred_Method_Of_Contact"] . '><br>';
        echo 'Birth date:<input type="text" name="birth_date" value=' . $result["BirthDate"] . '><br>';
        echo 'Gender:<input type="text" name="gender" value=' . $result["Gender"] . '><br>';
        echo 'Emergency contact phone number:<input type="text" name="contact_phone" value=' . $result["Emergency_Contact_Phone"] . '><br>';
        echo 'Emergency contact name:<input type="text" name="contact_name" value=' . $result["Emergency_Contact_Name"] . '><br>';
        echo 'Community service (y/n):<input type="text" name="community_service" value=' . $result["Community_Service"] . '><br>';
        ?>
        <br>
        <form action="landing_page.php">
            <input type="submit" name="button_logout" value="Save">
        </form>
        <form action="landing_page.php">
            <input type="submit" name="button_cancel" value="Cancel">
        </form>
    </center>
</body>
</html>